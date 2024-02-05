<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writer Login</title>
    <style>
        body {
            background: linear-gradient(135deg, #3498db, #8e44ad);
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
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

        .login-container h2 {
            color: #333;
        }

        .login-form {
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
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: 0.3s;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .login-btn {
            background-color: #3498db;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Writer Login</h2>
    <form class="login-form">
        <div class="form-group">
            <input type="text" id="username" name="username" required>
            <label for="username">Username</label>
        </div>

        <div class="form-group">
            <input type="password" id="password" name="password" required>
            <label for="password">Password</label>
        </div>

        <button type="submit" class="login-btn">Login</button>
    </form>
</div>

</body>
</html>
