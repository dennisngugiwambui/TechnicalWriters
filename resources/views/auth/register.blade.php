<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writer Registration</title>
    <link rel="icon" type="image/png" href="/Admin/img/writer.png">
    <!-- Font Awesome CSS (Include the link to Font Awesome in your project) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Your styles here */
        body {
            background: linear-gradient(135deg, #edebed, #edebed);
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .registration-container {
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

        .registration-container h2 {
            color: #333;
        }

        .registration-form {
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
        }

        .form-group input {
            width: calc(100% - 26px);
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: 0.3s;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding-left: 26px;
            box-sizing: border-box;
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

        .register-btn {
            background-color: #3498db;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .register-btn:hover {
            background-color: #2980b9;
        }

        .signup-link {
            font-size: 14px;
            margin-top: 10px;
            color: #777;
        }

        .signup-link a {
            color: #3498db;
            text-decoration: none;
        }

        .invalid-feedback {
            color: #ff0000; /* Red color for error messages */
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>

<div class="registration-container">
    <h2>Writer Registration</h2>
    <form class="registration-form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input type="text" id="name" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
            <label for="name"><i class="fas fa-user"></i> Name</label>
            @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input type="number" id="phone" name="phone">
            <label for="phone"><i class="fas fa-phone"></i> Phone</label>
            @error('phone')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input type="password" id="password" name="password" >
            <label for="password"><i class="fas fa-lock"></i> Password</label>
            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input type="password" id="password_confirmation" name="password_confirmation" >
            <label for="password_confirmation"><i class="fas fa-lock"></i> Confirm Password</label>
            @error('password_confirmation')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="register-btn">Register</button>

        <p class="signup-link">Already a member? <a href="{{ route('login') }}">Login here</a></p>
    </form>
</div>

</body>
</html>
