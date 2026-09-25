<?php

$json = '{
    "order_code": "260924ABC",
    "shop_id": "12345678",
    "status": "READY_TO_SHIP",
    "buyer": {
        "name": "Nguyễn Văn A",
        "phone": "0912345678"
    },
    "items": [
        {
            "sku": "KUC001",
            "name": "Máy lọc nước KUCHEN",
            "quantity": 1,
            "price": 9500000
        }
    ]
}';

$data = json_decode($json, true);

if (json_last_error() != JSON_ERROR_NONE) {
    echo "Lỗi JSON: " . json_last_error_msg() . "\n";
    exit;
}


echo $data['order_code'] . "\n";
echo $data['shop_id'] . "\n";
echo $data['status'] . "\n";
echo $data['buyer']['name'] . "\n";

echo $data['buyer']['phone'] . "\n" ?? 'Không có số điện thoại' . "\n";

$total = 0;

foreach ($data['items'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

echo "Tổng tiền: " . number_format($total) . " VNĐ";
