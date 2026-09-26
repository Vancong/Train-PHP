<?php
require_once 'config.php';
require_once 'model.php';
require_once 'auth.service.php';
session_start();

$model = new UserModel($pdo);
$service = new AuthenService($model);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($action === 'login') {
        $user = $service->login($email, $password);
        if ($user) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];

            header("Location: dashboard.php");
            exit;
        }
        $error = 'Email hoac mat khau khong dung';
    } elseif ($action === 'register') {
        $userId = $service->register($email, $password);
        if (!$userId) {
            $error = 'Email da ton tai';
        } else {
            header('Location: login.php');
            exit;
        }
    }
}
