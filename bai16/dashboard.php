<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user = [
    'email' => $_SESSION['email'],
    'role' => $_SESSION['role'],
    'id' => $_SESSION['user_id']
];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            text-align: center;
            padding: 50px;
        }

        .dashboard {
            width: 350px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
        }

        a {
            display: inline-block;
            padding: 8px 15px;
            background: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h1>Dashboard</h1>
        <p>Xin chào <?php echo $user['email']; ?>!</p>
        <p>Quyền: <?php echo $user['role']; ?></p>
        <p>Id: <?php echo $user['id']; ?></p>
        <a href="logout.php">Đăng xuất</a>
    </div>
</body>

</html>