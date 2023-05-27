<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #222;
            font-family: sans-serif;
        }

        .login-box {
            width: 300px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #f2b6a0;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .login-box h2 {
            margin: 0 0 30px;
            color: #222;
        }

        .user-box {
            position: relative;
            margin-bottom: 20px;
        }

        .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #222;
            border: none;
            border-bottom: 2px solid #222;
            outline: none;
            background: transparent;
        }

        .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            font-size: 16px;
            color: #222;
            pointer-events: none;
            transition: 0.5s;
        }

        .user-box input:focus~label,
        .user-box input:valid~label {
            top: -20px;
            left: 0;
            color: #222;
            font-size: 12px;
        }

        button[type="submit"] {
            border: none;
            outline: none;
            cursor: pointer;
            position: relative;
            display: inline-block;
            background: #be5a83;
            color: #222;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
        }

        button[type="submit"]:hover {
            background: #e06469;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <div class="user-box">
                <input type="text" name="usuario" required="">
                <label>Usuario</label>
            </div>
            <div class="user-box">
                <input type="password" name="pass" required="">
                <label>Contraseña</label>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>

</html>