<?php
function authenMiddeware()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

function adminMiddleware()
{
    if ($_SESSION['role'] !== 'admin') {
        echo '<p style="color: red;">Bạn không có quyền truy cập trang này</p>';
        echo ' <a href="dashboard.php">Quay lai</a>';
        exit;
    }
}
