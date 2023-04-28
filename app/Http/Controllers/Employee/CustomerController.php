<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    private $table;
    private $menu;
    private $order;
    private $orderDetail;

    private  $bill;
    public function __construct(Table $table, Menu $menu, Order $order, OrderDetail $orderDetail, Bill $bill)
    {
        $this->table = $table;
        $this->menu = $menu;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->bill = $bill;
    }

    public function showTableList()
    {
        $tables = $this->table->all();
        return view('employee.pages.order.table', compact('tables'));
    }

    public function selectItems($table)
    {
        $menus = $this->menu->all();

        $order = $this->order->where('table_id', $table)->where('status', false)->first();

        if ($order)
            $orderDetails = OrderDetail::select(DB::raw('SUM(quantity) as total_quantity'), 'order_id', 'item_id')->where('order_id', $order->id)
                ->groupBy('item_id', 'order_id')
                ->get();
        else
            $orderDetails = [];
        return view('employee.pages.order.items-list', compact('menus', 'table', 'orderDetails'));
    }

    public function addToCart($table, Request $request)
    {
        $currentOrder = $this->order->where('table_id', $table)->where('status', false)->first();

        if (!$currentOrder) {
            $newOrder = $this->order->create([
                'order_date' => date('Y-m-d H:i:s'),
                'status' => false, //false: Đơn hàng chưa được thanh toán, true: Đơn hàng đã được thanh toán
                'table_id' => $table,
            ]);

            $this->orderDetail->create([
                'quantity' => $request->quantity,
                'status' => 0,
                'note' => $request->note,
                'order_id' => $newOrder->id,
                'item_id' => $request->item_id
            ]);

            $this->table->find($table)->update([
                'status' => false
            ]);
        } else {
            $this->orderDetail->create([
                'quantity' => $request->quantity,
                'status' => 0,
                'note' => $request->note,
                'order_id' => $currentOrder->id,
                'item_id' => $request->item_id
            ]);
        }
        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        $orderDetail = $this->orderDetail->find($request->item_id);

        if ($orderDetail->status == 1) {
            $orderDetail->delete();
        }
    }

    public function payment($table)
    {
        $order = $this->order->where('table_id', $table)->where('status', false)->first();

        $amount = 0;
        foreach ($order->order_details as $orderDetail)
        {
            $amount += $orderDetail->item->price * $orderDetail->quantity;
        }

        return view('admin.pages.order.payment', compact('order','amount'));
    }
    public function comfirmPayment($table)
    {
        $order = $this->order->where('table_id', $table)->where('status', false)->first();

        $amount = 0;
        foreach ($order->order_details as $orderDetail)
        {
            $amount += $orderDetail->item->price * $orderDetail->quantity;
        }

        $newBill = $this->bill->create([
            'bill_date' => date('Y-m-d H:i:s'),
            'tax' => 0.1,
            'discount' => 0,
            'total' => $amount * 0.1,
            'payment_method' => "Tiền mặt",
            'customer_id' => null,
        ]);

        return view('admin.pages.order.payment', compact('newBill', 'amount'));
    }
}
