<?php
    $status = 3;
    $total = 12500000;
    $paymentStatus = 'paid';
    $orderStatus = 'completed'; 
    
    function checkStatus ($status) {
        if($status==0) {
            return "Đơn mới";
        }
        else if ($status===1) {
            return "Đã xác nhận";
        }
         else if ($status===2) {
            return "Đang đóng gói";
        }
         else if ($status===3) {
            return "Đang giao";
        }
         else if ($status===4) {
            return "Hoàn thành";
        }
         else if ($status===5) {
            return "Hủy";
        }
        else {
            return "Trạng thái không hợp lệ";
        }
    }

    $statusIfelse= checkStatus($status);



    function isCustomer ($total) {
        if($total < 5000000) {
            return "Khách Thường";
        }
        else if ($total<10000000) {
            return "Khách Tiềm năng";
        }
        else if ($total<20000000) {
            return "Khách VIP";
        }
        else {
            return "Khách VIP đặc biệt";
        }
    }

    $customerType = isCustomer($total);
   
    
    if ($paymentStatus === 'paid' && $orderStatus ==='completed') {
       $checkInvoice='Đủ điều kiện xuất hóa đơn';
    }
    else {
         $checkInvoice='Chưa đủ điều kiện xuất hóa đơn';
    }

    $statusNameMatch= match ($status) {
         0 => 'Đơn mới',
         1 => 'Đã xác nhận',
         2 => 'Đang đóng gói',
         3 => 'Đang giao',
         4 => 'Hoàn thành',
         5 => 'Hủy',
         default => 'Trạng thái không hợp lệ',
    };
   
    echo "Trạng thái đơn hàng: $statusIfelse \n";
    echo "Loại khách hàng: $customerType \n";
    echo $customerType."\n"; 
    echo "PHP 8+ su dung match $statusNameMatch";

?>  