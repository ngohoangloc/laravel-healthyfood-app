<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }


    public function index()
    {
        $customers = $this->customer->all();

        return view('admin.pages.customer.index', compact('customers'));
    }

    public function create(Request $request)
    {
        $this->customer->create([
            'name' => $request->name,
            'phone' => $request->phone
        ]);

        return redirect()->route('admin.customer.index');
    }

    public function update($id, Request $request)
    {
        $this->customer->find($id)->update([
            'name'=> $request->name,
            'phone' => $request->phone
        ]);

        return redirect()->route('admin.customer.index');
    }

    public function delete($id)
    {
        $this->customer->find($id)->delete();
        return redirect()->route('admin.customer.index');
    }
}
