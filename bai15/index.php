<?php
require_once './logger.php';

$orderCode = 'DH001';
try {
    echo "Bat dau\n";

    logMessage('INFO', 'Don hang ' . $orderCode . ' tao thanh cong');

    throw new Exception('ket noi time out');

    echo "Ket thuc\n";
} catch (Throwable $e) {
    logMessage('ERROR', " Don hang " . $orderCode . " - " . $e->getMessage());

    echo "Co loi xay ra\n";
}
