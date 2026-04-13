<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            height: 100vh;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 900px;
            height: 500px;
            display: flex;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            border-radius: 10px;
            overflow: hidden;
            background: white;
        }

        .left {
            width: 50%;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .left h2 {
            color: #1f3c88;
            margin-top: 20px;
        }

        .left p {
            font-size: 12px;
            color: #666;
        }

        .right {
            width: 50%;
            background: linear-gradient(135deg, #2c5aa0, #1f3c88);
            padding: 60px;
            color: white;
            position: relative;
        }

        .right h3 {
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: none;
            outline: none;
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background: #4e73df;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #2e59d9;
        }

        .remember {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .remember input {
            margin-right: 5px;
        }

        .error {
            background: #ff4d4d;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
                width: 95%;
            }
            .left, .right {
                width: 100%;
            }
            .right {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">
        <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" width="100">
        <h2>PINJEM DULU BOS</h2>
        <p>Sistem Peminjaman Alat</p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">

        <h3>Login Admin</h3>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="remember">
                <input type="checkbox"> Remember me
            </div>

            <button type="submit" class="btn-login">
                SIGN IN 
            </button>

        </form>
    </div>
</div>

</body>
</html>