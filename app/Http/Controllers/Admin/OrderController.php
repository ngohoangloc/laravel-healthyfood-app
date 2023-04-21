<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Table;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    private $table;
    private $menu;

    public function __construct(Table $table, Menu $menu)
    {
        $this->table = $table;
        $this->menu = $menu;
    }

    public function index()
    {
        $tables = $this->table->all();
        return view('admin.pages.order.table', compact('tables'));
    }

    public function order($table)
    {
        $menus = $this->menu->all();
        return view('admin.pages.order.index', compact('menus'));
    }

    public function payment($table)
    {

    }
}
