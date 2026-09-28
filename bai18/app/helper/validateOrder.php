<?php

function validateOrder($data)
{

    $customer_name = $data['customer_name'] ?? '';
    $phone = $data['phone'] ?? '';
    $source = $data['source'] ?? '';
    $order_code = $data['order_code'] ?? '';
    $status = $data['status'] ?? '';

    $errors = [];


    if (trim($customer_name) === '') {
        $errors[] = "Tên khách hàng không được để trống.";
    }


    if (trim($phone) === '') {
        $errors[] = "Số điện thoại không được để trống.";
    } else if (!is_numeric($phone)) {
        $errors[] = "Số điện thoại phải là số.";
    }




    if (trim($source) === '') {
        $errors[] = "Nguồn không được để trống.";
    }

    if (trim($order_code) === '') {
        $errors[] = "Mã đơn hàng không được để trống.";
    }

    if (trim($status) === '') {
        $errors[] = "Trạng thái không được để trống.";
    }

    return $errors;
}
