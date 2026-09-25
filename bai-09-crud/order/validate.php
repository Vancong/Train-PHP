<?php
function validateOrder($data): array
{
    $errors = [];
    if (empty($data['order_code'])) {
        $errors[] = 'Ma don hang khong duoc de trong';
    }
    if (empty($data['customer_name'])) {
        $errors[] = 'Ten khach hang khong duoc de trong';
    }
    if (empty($data['phone'])) {
        $errors[] = 'So dien thoai khong duoc de trong';
    }
    if (empty($data['source'])) {
        $errors[] = 'Nguồn đơn không được để trống';
    }
    if (empty($data['status'])) {
        $errors[] = 'Trạng thái đơn hàng không được để trống';
    }
    if (empty($data['total'])) {
        $errors[] = 'Tổng tiền đơn hàng không được để trống';
    }

    return $errors;
}
