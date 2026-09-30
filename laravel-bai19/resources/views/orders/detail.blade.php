<style>
    .container {
        width: 500px;
        margin: 100px auto;
    }

    .order {
        padding: 15px;
        background: #f5f5f5;
        border-radius: 6px;
    }
</style>

<div class="container">

    <h1>Chi tiết đơn hàng</h1>

    <div class="order">
        <p><strong>ID:</strong> {{ $order->id }}</p>
        <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
        <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
        <p><strong>Tổng tiền:</strong> {{ $order->total }}</p>
        <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
    </div>

    <a href="/orders">Quay lại</a>

</div>