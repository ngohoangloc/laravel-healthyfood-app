<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Menu;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $item, $menu;

    public function __construct(Item $item, Menu $menu)
    {
        $this->item = $item;
        $this->menu = $menu;
    }

    public function index()
    {
        $items = $this->item->all();
        $menus = $this->menu->all();
        return view('admin.pages.item.index', compact('items', 'menus'));
    }
}
