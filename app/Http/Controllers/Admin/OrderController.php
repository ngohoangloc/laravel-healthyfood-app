<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Table;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;
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
        return view('admin.pages.order.items-list', compact('menus', 'table'));
    }

    public function addToCart($table, Request $request)
    {
        $order = $this->order->where('table_id', $table)->where('status', false)->get();

        if (!$order) {
            $order = $this->order->create([
                'order_date' => date('d/m/Y h:i:s a', time()),
                'status' => false,
                'customer_id' => null,
                'table_id' => $table,
            ]);

            $order->order_details->create([]);
        } else {
        }
    }

    public function payment($table)
    {
    }
}
