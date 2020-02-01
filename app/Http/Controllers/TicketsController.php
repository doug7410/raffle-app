<?php

namespace App\Http\Controllers;

use App\Ticket;
use Pusher\Pusher;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     * @throws \Pusher\PusherException
     */
    public function index()
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            ['cluster' => 'us2', 'useTLS' => true]
        );

        if (session('ticket_number')) {
            if (Ticket::where(['ticket_number' => session('ticket_number')])->first()) {
                return view('ticket', ['ticket' => session('ticket_number')]);
            }
        }

        $ticket = Ticket::create(['ticket_number' => (string)rand(100000, 999999)]);
        session(['ticket_number' => $ticket->ticket_number]);
        $pusher->trigger('raffle', 'ticket-created', $ticket);
        return view('ticket', ['ticket' => $ticket->ticket_number]);
    }

    public function show()
    {
        $tickets = Ticket::all(['id', 'ticket_number']);
        return view('tickets', [
            'tickets' => $tickets->toArray()
        ]);
    }

    public function delete(Request $request)
    {
        Ticket::destroy([$request->input('ticketId')]);
        return $tickets = Ticket::all(['id', 'ticket_number']);
    }
}
