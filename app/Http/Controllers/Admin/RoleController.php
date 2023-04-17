<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        $roles = $this->role->all();

        return view('admin.pages.role.index', compact('roles'));
    }

    public function create(Request $request)
    {
        $this->role->create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.role.index');
    }

    public function edit($id, Request $request)
    {
        $this->role->find($id)->update([
            'name' => $request->name,
        ]);
        
        return redirect()->route('admin.role.index');
    }

    public function delete($id)
    {
        $this->role->find($id)->delete();
        return redirect()->route('admin.role.index');
    }
}
