<?php

$orderCode = 'DH001';

$url = 'https://github.com/Vancong/Train-PHP/fdssdffd';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_TIMEOUT, 10);


$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    echo "Khong the ket noi \n";
    $erroCode = curl_errno($ch);
    $erroMessage = curl_error($ch);
    error_log("Don hang $orderCode - API loi $erroCode: $erroMessage" . PHP_EOL, 3, __DIR__ . './log/api.log');
    curl_close($ch);
    exit;
}




if ($httpCode == 200) {
    echo "API thành công \n";
} else if ($httpCode == 400) {
    echo "Dữ liệu gửi lên không hợp lệ \n";
} else if ($httpCode == 401) {
    echo "không có quyền truy cập \n";
} else if ($httpCode == 404) {
    echo " Không tìm thấy trang \n";
} else if ($httpCode == 500) {
    echo "lỗi máy chủ \n";
} else {
    echo "lỗi không xác định \n";
}

if ($httpCode != 200) {

    error_log("Don hang $orderCode - API loi $httpCode" . PHP_EOL, 3, __DIR__ . './log/api.log');
}


curl_close($ch);
