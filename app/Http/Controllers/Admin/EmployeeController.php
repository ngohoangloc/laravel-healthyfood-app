<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $employee;

    public function __construct(User $user)
    {
        $this->employee = $user;
    }

    public function index()
    {
        $employees = $this->employee->all();
        return view('admin.pages.employee.index', compact('employees'));
    }
}
