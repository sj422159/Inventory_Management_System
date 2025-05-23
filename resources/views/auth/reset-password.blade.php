<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter :wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #74ebd5 0%, #AC92EB 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px 35px;
            animation: fadeInUp 0.6s ease-out;
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

        h2 {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        p.text-muted {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-field {
            width: 100%;
            padding: 14px 16px 10px 16px;
            font-size: 16px;
            border: none;
            border-radius: 12px;
            background-color: #f1f3f6;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background-color: #ffffff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        .label-float {
            position: absolute;
            top: 14px;
            left: 16px;
            color: #999;
            font-size: 16px;
            pointer-events: none;
            transition: 0.3s ease all;
        }

        .input-field:focus + .label-float,
        .input-field:not(:placeholder-shown) + .label-float {
            top: -10px;
            font-size: 12px;
            color: #555;
            background-color: #fff;
            padding: 0 4px;
        }

        .show-password-btn {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 13px;
            color: #777;
            user-select: none;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #2c3e50, #1a252f);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #34495e, #1c2833);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .alert {
            background-color: #ffdddd;
            color: #d8000c;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-success {
            background-color: #e6ffe6;
            color: green;
        }

        .logo {
            display: block;
            margin: auto;
            width: 50px;
            height: 50px;
            margin-bottom: 1rem;
        }

        @media (max-width: 500px) {
            .card {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="text-center mb-3">
        <!-- Replace with your logo -->
        <!-- <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo"> -->
        <h2>Reset Your Password</h2>
        <p class="text-muted">Choose a new password for your account.</p>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <input type="email" id="email" name="email" class="input-field"
                   placeholder=" " value="{{ old('email', request('email')) }}" required autofocus />
            <label for="email" class="label-float">Email Address</label>
        </div>

        <!-- New Password -->
        <div class="form-group position-relative">
            <input type="password" id="password" name="password" class="input-field" placeholder=" " required />
            <label for="password" class="label-float">New Password</label>
            <span class="show-password-btn" onclick="togglePassword('password')">Show</span>
        </div>

        <!-- Confirm Password -->
        <div class="form-group position-relative">
            <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" placeholder=" " required />
            <label for="password_confirmation" class="label-float">Confirm Password</label>
            <span class="show-password-btn" onclick="togglePassword('password_confirmation')">Show</span>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn">Reset Password</button>
    </form>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = event.target;
        if (input.type === "password") {
            input.type = "text";
            icon.textContent = "Hide";
        } else {
            input.type = "password";
            icon.textContent = "Show";
        }
    }
</script>

</body>
</html>