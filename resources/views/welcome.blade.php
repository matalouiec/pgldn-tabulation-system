<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Miss Lanao del Norte 2019</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-image: url("/storage/img/backdrop.jpg");
                background-size: cover;
                background-repeat: no-repeat;
                background-color: black;
                background-position: center center;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .btn{
                position: absolute;
                bottom: 2%;
                width: 180px;
                margin: auto;
                right: auto;
                left: 45%;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                @if (Route::has('login'))
                    <div class="start">
                        @auth
                            <a class="btn btn-success btn-lg" role="button" href="{{ url('/dashboard') }}">SCORE CARD</a>
                        @else
                            <a class="btn btn-success btn-lg" role="button" href="{{ route('login') }}">LOG IN</a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
