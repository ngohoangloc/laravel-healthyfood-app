<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    private $employee;
    private $account;
    private $role;

    public function __construct(User $user, Account $account, Role $role)
    {
        $this->employee = $user;
        $this->account = $account;
        $this->role = $role;
    }

    public function index()
    {
        $employees = $this->employee->all();
        $roles = $this->role->all();
        return view('admin.pages.employee.index', compact('employees'));
    }

    public function create(Request $request)
    {
        if (!$this->account->where('username', $request->username)) {
            $user = $this->account->create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'active' => true,
            ]);

            $this->employee->create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'account_id' => $user->id,
            ]);
        }
        return redirect()->route('admin.employee.index');
    }

    public function update($id, Request $request)
    {
        $this->employee->find($id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return redirect()->route('admin.employee.index');
    }

    public function delete($id)
    {
        $this->employee->find($id)->delete();
        return redirect()->route('admin.employee.index');
    }
}
