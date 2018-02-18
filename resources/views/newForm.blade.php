<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>New Form</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
<div class="flex-center position-ref">
    <div class="row content">
        <h1 class="title"> New Form </h1>

        <div class="form">
            <form id="user-form" class="form form-horizontal">
                <div class="">
                    <label for="user_name" class="label label-primary">User Name:</label>
                    <input type="text" name="user_name" class="user-name form-control" id="user-name" value="">
                </div><br>
                <div class="">
                    <label for="email" class="label label-primary">Email:</label>
                    <input type="email" name="email" class="email form-control" id="email" value="">
                </div><br>
                <div class="">
                    <label for="mobile" class="label label-primary">Email:</label>
                    <input type="text" name="mobile" class="mobile form-control" id="mobile" value="">
                </div><br>
                <div>
                    <input type="submit" value="Submit" class="btn btn-sm btn-primary" style="font-style: italic;">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
