<template>
    <div>
        <h1>Sunshine PHP 2020</h1>
        <h3>Serverless Talk Raffle</h3>
        <div class="mix">
            <button class="btn btn--stripe btn--large" @click="mixUpTickets()">
                Mix them up
            </button>
        </div>
        <div>
            <div class="winner" v-if="tickets.length > 1">
                <div class="title">🎉 <strong>winner</strong> 🎉</div>
                <div class="tixContainer single-ticket">
                    <a class="tix" href="#" @click.prevent="chooseTicket(winner.id)">
                        <div class="tixInner">
                            <span>{{ winner.ticket_number }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <transition-group name="flip-list" class="tickets">
            <div class="tixContainer" v-for="ticket in tickets" :key="ticket.id">
                <div class="tix">
                    <div class="tixInner">
                        <span>{{ ticket.ticket_number }}</span>
                    </div>
                </div>
            </div>
        </transition-group>
    </div>

</template>

<script>
    import axios from 'axios'
    import {shuffle} from 'lodash'

    const pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
        cluster: 'us2',
        forceTLS: true
    })

    const channel = pusher.subscribe('raffle')

    export default {
        name: 'Tickets',
        data() {
            return {
                channel,
                tickets: []
            }
        },
        props: ['initialTickets'],
        methods: {
            chooseTicket(id) {
                axios.post('api/choose_ticket/', {
                    ticketId: id
                }).then(response => {
                    this.tickets = response.data
                })
            },
            mixUpTickets() {
                this.tickets = shuffle(this.tickets)
            }
        },
        computed: {
            winner() {
                return this.tickets[0]
            }
        },
        created() {
            this.tickets = this.initialTickets
            this.channel.bind('ticket-created', (ticket) => {
                this.tickets.push(ticket)
            })
        }
    }
</script>

<style scoped lang="scss">
    a:hover {
        text-decoration: none;
    }

    .winner {
        width: 275px;
        margin: 0 auto;
        background-color: #41cc7a;
        padding: 19px;
        border-radius: 5px;

        .title {
            color: #0c6ae2;
            text-align: center;
            font-size: 1.8em;
        }
    }

    h1, h3 {
        color: #B74025;
        text-align: center;
    }

    h3 {
        margin-bottom: 2.5em;
    }
</style>
