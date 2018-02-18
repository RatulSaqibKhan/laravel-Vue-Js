<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
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

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Demo
                </div>

                <div class="links">
                    <a href="{{URL::to('new-file')}}">New File</a>
                    <a href="{{URL::to('user-list')}}">User List</a>
                    <a href="{{URL::to('multiple-row')}}">Multiple Row</a>
                    <a href="{{URL::to('multiple-row-calculation')}}">Multiple Row Calculation</a>
                    <a href="{{URL::to('multiple-row-calculation-example')}}">Multiple Row Calculation(Example)</a>
                    <a href="{{URL::to('simple-calculator')}}">Simple Calculator(Example)</a>
                    <a href="{{URL::to('exam-test')}}">Exam Test</a>
                    <a href="{{URL::to('pagination-test')}}">Pagination Test(Old)</a>
                    <a href="{{URL::to('pagination-test-new')}}">Pagination Test(New)</a>
                    <a href="{{URL::to('search-table-data')}}">Search Table Data(Old)</a>
                    <a href="{{URL::to('search-table-data-new')}}">Search Table Data(New)</a>
                </div>
            </div>
        </div>
    </body>
</html>
