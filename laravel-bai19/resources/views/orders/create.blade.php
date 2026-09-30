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
        background: #27ae60;
        color: white;
        border: 0;
        border-radius: 4px;
        cursor: pointer;
    }

    .error {
        color: red;
        font-size: 14px;
    }
</style>

<div class="container">

    <h1>Thêm đơn hàng</h1>

    <form action="/orders/create" method="POST">
        @csrf

        <div>
            <label>Tên khách hàng</label>
            <input
                type="text"
                name="customer_name"
                value="{{ old('customer_name') }}"
                onkeydown="if (/[0-9]/.test(event.key)) event.preventDefault()">

            @error('customer_name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Số điện thoại</label>
            <input
                type="text"
                name="phone"
                inputmode="numeric"
                maxlength="10"
                value="{{ old('phone') }}"
                onkeydown="if (event.key.length === 1 && !/[0-9]/.test(event.key)) event.preventDefault()">

            @error('phone')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Tổng tiền</label>
            <input
                type="number"
                name="total"
                value="{{ old('total') }}">

            @error('total')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Trạng thái</label>
            <select name="status">
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit">Lưu</button>
        <a href="/orders">Quay lại</a>

    </form>

</div>