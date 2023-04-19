<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Traits;

class ItemController extends Controller
{
    use Traits\StorageImageTrait;
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

    public function create(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'menu_id' => $request->menu_id
        ];

        $dataUploadImages = $this->storageTraitUpload($request, 'img_path', 'item');
        if (!empty($dataUploadImages)) {
            $data['img_path'] = $dataUploadImages['file_path'];
        }

        $item = $this->item->create($data);

        return redirect()->route('admin.item.index');
    }

    public function update($id, Request $request)
    {
        $this->item->find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'menu_id' => $request->menu_id
        ]);

        return redirect()->route('admin.item.index');
    }

    public function delete($id)
    {
        $this->item->find($id)->delete();
        return redirect()->route('admin.item.index');
    }
}
