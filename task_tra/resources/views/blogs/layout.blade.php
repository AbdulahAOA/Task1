<!DOCTYPE html>
<html lang="en">
@extends('layouts.app')
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blogs</title>

    <style>
        body {
            font-family: Arial;
            margin: 40px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }

        .container {
            width: 70%;
            margin: auto;
        }

        img {
            margin-top: 10px;
        }
    </style>

</head>

<body>

    <div class="container">

        @yield('content')

    </div>

</body>

</html>
