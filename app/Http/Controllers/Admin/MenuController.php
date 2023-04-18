<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    private $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function index()
    {
        $menus = $this->menu->all();
        return view('admin.pages.menu.index', compact('menus'));
    }

    public function create(Request $request)
    {
        $this->menu->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.menu.index');
    }

    public function update($id, Request $request)
    {
        $this->menu->find($id)->update([
            'name'=> $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.menu.index');
    }

    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route('admin.menu.index');
    }
}
