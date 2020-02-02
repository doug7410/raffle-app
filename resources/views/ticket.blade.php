<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        #app {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tixContainer {
            position: relative;
            margin: 146px;
            transform: scale(3);
        }

        .links {
            position: relative;
            top: 40px;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="tixContainer">
            <div class="tix" href="#">
                <div class="tixInner">
                    <span>{{ $ticket }}</span>
                </div>
            </div>
            <div class="links">
                <a href="https://github.com/doug7410/sunshine-php-2020">https://github.com/doug7410/sunshine-php-2020</a>
            </div>
        </div>

    </div>

</body>

</html>

