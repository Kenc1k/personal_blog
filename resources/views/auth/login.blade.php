<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .login-container {
            background: linear-gradient(145deg, #6c7bff, #5f6bff);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-form {
            width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
        }

        .input-group input:focus {
            border-color: #6c7bff;
            outline: none;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #6c7bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #5f6bff;
        }

        .links {
            text-align: center;
            margin-top: 10px;
        }

        .links a {
            display: inline-block;
            color: #6c7bff;
            font-size: 14px;
            text-decoration: none;
            margin-top: 5px;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-form">
        <h2>Login</h2>
        @if ($errors->has('loginError'))
            <div style="color: rgb(25, 19, 107); text-align: center; margin-bottom: 15px;">
                {{ $errors->first('loginError') }}
            </div>
        @endif
        <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>

            <div class="links">
                <a href="#">Forgot Password?</a>
                <a href="{{route('registerPage')}}">Create an Account</a>
            </div>
        </form>

    </div>
</div>
</body>
</html>
