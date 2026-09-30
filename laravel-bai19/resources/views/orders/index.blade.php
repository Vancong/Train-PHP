<style>
    .container {
        max-width: 800px;
        margin: 50px auto;
    }

    .order {
        padding: 12px;
        margin: 10px 0;
        background: #f5f5f5;
        border-radius: 6px;
    }

    .btn {
        padding: 5px 10px;
        text-decoration: none;
        border: 0;
        border-radius: 4px;
        cursor: pointer;
    }

    .view {
        background: #3498db;
        color: white;
    }

    .edit {
        background: #f39c12;
        color: white;
    }

    .delete {
        background: #e74c3c;
        color: white;
    }

    .add {
        display: inline-block;
        background: #27ae60;
        color: white;
        margin-bottom: 15px;
    }
</style>

<div class="container">

    <h1>Danh sách đơn hàng</h1>
    <a href="/orders/create" class="btn add">+ Thêm đơn hàng</a>
    @foreach ($orders as $order)
    <div class="order">
        <strong>STT: {{ $loop->iteration }}</strong>
        <br>

        {{ $order->customer_name }}
        - {{ $order->phone }}
        - {{ $order->total }}
        - {{ $order->status }}

        <a href="/orders/{{ $order->id }}" class="btn view">Xem</a>

        <a href="/orders/edit/{{ $order->id }}" class="btn edit">Sửa</a>

        <form action="/orders/delete/{{ $order->id }}" method="POST" style="display:inline">
            @csrf
            @method('PUT')

            <button class="btn delete"
                onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                Xóa
            </button>
        </form>
    </div>
    @endforeach

</div>