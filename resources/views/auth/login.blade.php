<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory Management System</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('frontend/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <!-- Toastr for alerts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css ">

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: #f9f9f9;
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
    }

    .main {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        margin: auto;
        animation: fadeInDown 1s ease-in-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .signin-image img {
        border-radius: 10px;
        width: 100%;
        max-width: 300px;
        height: auto;
    }

    .signin-form {
        padding: 30px;
    }

    .form-title {
        color: #222;
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-group label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        color: #666;
        font-size: 1.2rem;
    }

    .form-group input[type="email"],
    .form-group input[type="password"] {
        width: 100%;
        padding: 10px 10px 10px 40px;
        background-color: #f0f0f0;
        color: #333;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }

    .form-group input::placeholder {
        color: #999;
    }

    .form-submit {
        background: #4e54c8;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        color: #ffffff;
        font-weight: bold;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .form-submit:hover {
        background: #3c41a9;
    }

    .signup-image-link,
    .forgot-password-link a {
        color: #4e54c8;
        text-decoration: underline;
        font-weight: 500;
    }

    .signup-image-link:hover,
    .forgot-password-link a:hover {
        color: #2e329b;
    }

    .text-danger {
        font-size: 0.85rem;
        color: #d9534f;
        margin-top: 5px;
        display: block;
    }

    .label-agree-term {
        color: #333;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .agree-term {
        margin-right: 10px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 12px 15px;
        font-weight: 500;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 12px 15px;
        font-weight: 500;
        border-radius: 5px;
        margin-bottom: 15px;
    }
</style>

</head>
<body>

<div class="main">
    <!-- Sign In Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{ asset('frontend/images/signin-image.jpg') }}" alt="Sign in image"></figure>
                    <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Welcome Back!</h2>

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="register-form" id="login-form">
                        @csrf

                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email material-icons-name"></i></label>
                            <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password" required/>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- In your login or registration form -->
<div style="display: none;">
    <label for="website">Enter Your Website:</label>
    <input type="text" name="website" id="website" />
</div>

                        <!-- Remember Me -->
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term">
                                <span><span></span></span>Remember me
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>

                    <!-- Forgot Password Link -->
                    <div class="forgot-password-link text-center mt-3">
                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JS -->
<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js "></script>

<!-- Show Toastr Alerts from Laravel Session -->
<script>
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif

    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>

</body>
</html>