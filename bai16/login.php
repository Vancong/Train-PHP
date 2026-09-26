<?php
require_once './controller.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            padding: 50px;
        }

        form {
            width: 300px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0 15px;
            box-sizing: border-box;
        }

        button {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
        }

        button[type="submit"] {
            background: #2563eb;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Đăng nhập</h1>

    <form method="POST">
        <input type="hidden" name="action" value="login">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
        <button type="button" onclick="window.location.href='register.php'">Register</button>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

    </form>

</body>

</html>