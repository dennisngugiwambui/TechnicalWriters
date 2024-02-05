<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="icon" type="image/png" href="/Admin/img/writer.png">
    <!-- Font Awesome CSS (Include the link to Font Awesome in your project) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #edebed, #edebed);
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .password-reset-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 400px;
            max-width: 100%;
            padding: 20px;
            text-align: center;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .password-reset-container h2 {
            color: #333;
        }

        .password-reset-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            background-color: #fff;
            padding: 0 5px;
            color: #777;
            transition: 0.3s;
            font-size: 14px; /* Adjust label font size */
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: 0.3s;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            outline: none; /* Remove blue border on focus */
        }

        .form-group input:focus {
            border-color: #3498db;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.5);
        }

        .form-group input:focus + label {
            top: 5px;
            font-size: 12px;
            color: #3498db;
        }

        .reset-btn {
            background-color: #3498db;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .reset-btn:hover {
            background-color: #2980b9;
        }

        .login-link {
            font-size: 14px;
            margin-top: 10px;
            color: #777;
        }

        .login-link a {
            color: #3498db;
            text-decoration: none;
        }

        .invalid-feedback {
            color: #ff0000;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>

<div class="password-reset-container">
    <h2>Password Reset</h2>
    <form class="password-reset-form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
            <label for="email">{{ __('Email Address') }}</label>

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="reset-btn">
            {{ __('Send Password Reset Link') }}
        </button>
    </form>
</div>

</body>
</html>
