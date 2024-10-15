<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        
        .bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .login-form {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 8px 24px 24px 24px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            justify-content: center;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-content {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 0px;
            outline: none;
        }

        .form-group input:focus {
            border: 1px solid #2986cc;
        }

        .form-group button {
            padding: 10px;
            background-color: #2986cc;
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .form-group button:hover {
            background-color: #0b5394;
        }

        .form-group {
            display: flex;
            flex-direction: row;
            gap: 8px;
            justify-content: center;
            align-items: center;
        }

        .alert {
            background-color: #fdc8c8;
            border-radius: 4px;
            color: #f44336;
            padding: 8px 12px;
            width: auto;
            margin: 12px 0px;
        }
    </style>
</head>
<body>
    <!-- Background Video -->
    <video class="bg-video" autoplay loop muted>
    <source src="{{ asset('videos/background.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Login Form -->
    <div class="login-form">
        <div class="form-container">
            <h2>Silakan Login</h2>

            @if(session('error'))
            <div class="alert">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
            <form action="{{ route('actionlogin') }}" method="post">
            @csrf
                <div class="form-content">
                    <div class="form-group">
                        <i data-feather="mail" style="width: 24px; height: 24px; color: #000000"></i>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div class="form-group">
                        <i data-feather="lock" style="width: 24px; height: 24px; color: #000000"></i>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Log In</button>                
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
      feather.replace();
    </script>
</body>
</html>