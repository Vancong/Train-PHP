<?php 
    $orders = [
        ['order_code'=>'DH001','customer'=>'Nguyễn Văn A','source'=>'Shopee Kuchen','total'=>7500000,'status'=>'completed'],
        ['order_code'=>'DH002','customer'=>'Trần Văn B','source'=>'Website','total'=>4500000,'status'=>'processing'],
        ['order_code'=>'DH003','customer'=>'Lê Văn C','source'=>'Shopee Kuchen','total'=>12000000,'status'=>'completed'],
    ];

    $tong =0;

    foreach($orders as $order) {
        echo $order['order_code'] . "\n";
        $tong+=$order['total'];
    }

    echo "Tong so don " . count($orders) . "\n";
    echo "Tong doanh thu: " . number_format($tong) . " VND \n";

?>