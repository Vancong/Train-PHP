<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('is_deleted', false)->get();
        return view('orders.index', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::findOrFail($id);
        if (!$order) {
            return 'Không tồn tại đơn hàng';
        }
        return view('orders.detail', compact('order'));
    }
    public function create()
    {
        return view('orders.create');
    }

    public function createSubmit(OrderRequest $request)
    {
        $order = Order::create($request->validated());
        return redirect('/orders');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    public function editSubmit(OrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update($request->validated());
        return redirect('/orders');
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        if (!$order) {
            return 'Không tồn tại đơn hàng';
        }
        $order->update([
            'is_deleted' => true
        ]);
        return redirect('/orders');
    }
}
