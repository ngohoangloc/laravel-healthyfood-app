<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $table;
    private $menu;
    private $order;
    private $orderDetail;

    private $customer;

    private  $bill;
    public function __construct(Table $table, Menu $menu, Order $order, OrderDetail $orderDetail, Bill $bill, Customer $customer)
    {
        $this->table = $table;
        $this->menu = $menu;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->bill = $bill;
        $this->customer = $customer;
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

        $orderDetails = OrderDetail::select(DB::raw('SUM(quantity) as total_quantity'), 'order_id', 'item_id')->where('order_id', $order->id)
            ->groupBy('item_id', 'order_id')
            ->get();

        $amount = 0;


        foreach ($orderDetails as $orderDetail)
        {
            $amount += $orderDetail->item->price * $orderDetail->total_quantity;
        }


        $bill = $this->bill->create([
            'bill_date' => date('Y-m-d H:i:s'),
            'tax' => ($amount * 0.1) ,
            'discount' => 0,
            'total' => ($amount * 0.1 + $amount),
            'payment_method' => "Tiền mặt",
            'order_id' => $order->id,
            'customer_id' => null,
            'user_id' => session()->get('user_id')
        ]);

        return view('employee.pages.order.payment', compact('bill','amount', 'table', 'orderDetails'));
    }
    public function comfirmPayment($table, Request $request)
    {
        $order = $this->order->where('table_id', $table)->where('status', false)->first()->update([
            'status' => true,
        ]);

        $cusomer = $this->customer->where('phone', $request->phone)->first();

        if ($cusomer)
            $order->update([
                'customer_id' => $cusomer->id,
            ]);
        else
        {
            $cusomer = $this->customer->create([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
            $order->update([
                'customer_id' => $cusomer->id,
            ]);
        }
        $this->table->find($table)->update([
            'status' => true,
        ]);

        return redirect('/employee/table');
    }
}
