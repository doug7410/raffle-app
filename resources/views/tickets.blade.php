<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .tickets {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .flip-list-move {
            transition: transform .7s;
        }

        .mix {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
<div id="app">
    <div>
        <tickets :initial-tickets='{!! json_encode($tickets) !!}'></tickets>
    </div>
</div>
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
