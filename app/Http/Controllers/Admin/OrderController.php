<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Table;
use DateTime;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    private $table;
    private $menu;
    private $order;
    private $orderDetail;

    public function __construct(Table $table, Menu $menu, Order $order, OrderDetail $orderDetail)
    {
        $this->table = $table;
        $this->menu = $menu;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
    }

    public function showTableList()
    {
        $tables = $this->table->all();
        return view('admin.pages.order.table', compact('tables'));
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
        return view('admin.pages.order.items-list', compact('menus', 'table', 'orderDetails'));
    }

    public function addToCart($table, Request $request)
    {
        $currentOrder = $this->order->where('table_id', $table)->where('status', false)->first();

        if (!$currentOrder) {
            $newOrder = $this->order->create([
                'order_date' => date('Y-m-d H:i:s'),
                'status' => false, //false: Đơn hàng chưa được thanh toán, true: Đơn hàng đã được thanh toán
                'note' => null,
                'table_id' => $table,
            ]);

            $this->orderDetail->create([
                'quantity' => $request->quantity,
                'status' => 0,
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

    public function confirmOrder($table, Request $request)
    {
        $order = $this->order->where('table_id', $table)->where('status', false)->first();

        $order->update([
            'note' => trim($request->note)
        ]);

        foreach ($order->order_details as $order_detail) {
            $order_detail->update([
                'status' => 1,
            ]);
        }

        return redirect()->back();
    }

    public function payment($table)
    {
    }
}
