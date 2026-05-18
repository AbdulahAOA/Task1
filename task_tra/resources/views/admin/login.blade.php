<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Admin Login
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter',sans-serif;
            background:linear-gradient(135deg,#0f172a 0%,#1e293b 50%,#0f172a 100%);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
        }

        .login-card{
            width:100%;
            max-width:450px;
            background:rgba(255,255,255,0.05);
            backdrop-filter:blur(15px);
            border-radius:25px;
            padding:40px;
            border:1px solid rgba(255,255,255,0.1);
        }

        .title{
            text-align:center;
            margin-bottom:35px;
        }

        .title i{
            font-size:60px;
            color:#14b8a6;
            margin-bottom:15px;
        }

        .title h1{
            color:white;
            margin-bottom:10px;
        }

        .title p{
            color:#94a3b8;
        }

        .input-group{
            margin-bottom:20px;
        }

        .input-group label{
            color:white;
            display:block;
            margin-bottom:8px;
        }

        .input-group input{
            width:100%;
            padding:14px;
            border:none;
            border-radius:15px;
            background:rgba(255,255,255,0.08);
            color:white;
            outline:none;
        }

        .input-group input::placeholder{
            color:#94a3b8;
        }

        .login-btn{
            width:100%;
            padding:14px;
            border:none;
            border-radius:20px;
            background:linear-gradient(135deg,#14b8a6,#0f766e);
            color:white;
            font-size:16px;
            cursor:pointer;
            transition:.3s;
        }

        .login-btn:hover{
            transform:translateY(-2px);
        }

        .alert{
            padding:12px;
            border-radius:10px;
            margin-bottom:20px;
        }

        .alert-danger{
            background:#dc3545;
            color:white;
        }

        .alert-success{
            background:#198754;
            color:white;
        }

    </style>

</head>

<body>

<div class="login-card">

    <div class="title">

        <i class="fas fa-user-shield"></i>

        <h1>
            Admin Login
        </h1>

        <p>
            Secure authentication required
        </p>

    </div>

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <form action="{{ route('admin.login') }}"
          method="POST">

        @csrf

        <div class="input-group">

            <label>
                Email
            </label>

            <input type="email"
                   name="email"
                   placeholder="admin@gmail.com">

            @error('email')

                <small style="color:red">

                    {{ $message }}

                </small>

            @enderror

        </div>

        <div class="input-group">

            <label>
                Password
            </label>

            <input type="password"
                   name="password"
                   placeholder="********">

            @error('password')

                <small style="color:red">

                    {{ $message }}

                </small>

            @enderror

        </div>

        <button type="submit"
                class="login-btn">

            Login

        </button>

    </form>

</div>

</body>

</html>