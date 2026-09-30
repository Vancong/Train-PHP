<style>
    .container {
        width: 400px;
        margin: 50px auto;
    }

    input,
    select {
        width: 100%;
        padding: 8px;
        margin: 6px 0;
        box-sizing: border-box;
    }

    button {
        padding: 8px 15px;
        background: #f39c12;
        color: white;
        border: 0;
        border-radius: 4px;
        cursor: pointer;
    }

    .add {
        display: inline-block;
        background: #27ae60;
        color: white;
        margin-bottom: 15px;
    }
</style>

<div class="container">

    <h1>Sửa đơn hàng</h1>

    <form action="/orders/edit/{{ $order->id }}" method="POST">
        @csrf
        @method('PUT')

        <input
            type="text"
            name="customer_name"
            placeholder="Tên khách hàng"
            value="{{ old('customer_name', $order->customer_name) }}"
            onkeydown="if (/[0-9]/.test(event.key)) event.preventDefault()">
        @error('customer_name')
        <p style="color: red">{{ $message }}</p>
        @enderror

        <input
            type="text"
            name="phone"
            inputmode="numeric"
            placeholder="Số điện thoại"
            onkeydown="if (event.key.length === 1 && !/[0-9]/.test(event.key)) event.preventDefault()"
            value="{{ old('phone', $order->phone) }}">
        @error('phone')
        <p style="color: red">{{ $message }}</p>
        @enderror

        <input
            type="number"
            name="total"
            placeholder="Tổng tiền"
            value="{{ old('total', $order->total) }}">
        @error('total')
        <p style="color: red">{{ $message }}</p>
        @enderror

        <select name="status">
            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>
                Processing
            </option>

            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>
                Completed
            </option>
        </select>

        <button type="submit">Cập nhật</button>
        <a href="/orders">Quay lại</a>
    </form>



</div>