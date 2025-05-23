<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Your Password</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter :wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* Global Styles */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #e0eafc, #cfdef3);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .container {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      max-width: 420px;
      width: 100%;
      padding: 30px 35px;
      animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
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
      font-size: 24px;
      font-weight: 700;
      color: #333;
      text-align: center;
      margin-bottom: 10px;
    }

    p {
      text-align: center;
      color: #666;
      font-size: 14px;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-size: 14px;
      margin-bottom: 6px;
      color: #555;
    }

    input[type="email"] {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 10px;
      outline: none;
      transition: all 0.3s ease;
    }

    input[type="email"]:focus {
      border-color: #74b9ff;
      box-shadow: 0 0 8px rgba(116, 185, 255, 0.4);
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #546e7a, #263238);
      color: white;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .submit-btn:hover {
      background: linear-gradient(135deg, #455a64, #263238);
      transform: translateY(-2px);
    }

    .submit-btn:active {
      transform: translateY(0);
    }

    .icon-arrow {
      margin-left: 8px;
      vertical-align: middle;
      transition: transform 0.3s ease;
    }

    .submit-btn:hover .icon-arrow {
      transform: translateX(4px);
    }

    @media (max-width: 500px) {
      .container {
        padding: 25px 20px;
      }
    }

    .error-message {
      color: red;
      font-size: 13px;
      margin-top: 5px;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Reset Your Password</h2>
    <p>Enter your email address and we’ll send you a link to reset your password.</p>

    <!-- Show error if any -->
    @if ($errors->any())
      <div class="error-message">
        {{ $errors->first() }}
      </div>
    @endif

    <!-- Success message -->
    @if (session('status'))
      <div class="success-message" style="color:green;text-align:center;margin-bottom:20px;">
        {{ session('status') }}
      </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus />
      </div>

      <button type="submit" class="submit-btn">
        Send Reset Link
        <svg class="icon-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </button>
    </form>
  </div>

</body>
</html>