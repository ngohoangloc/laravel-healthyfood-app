<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function showLogin()
    {
        if (session()->has('user')) {
            if (session()->get('role') == 1)
                return redirect('/admin');
            else
                return redirect('404');
        } else
            return view('auth.login');
    }

    public function login(Request $request)
    {

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        $account = $this->account->where('username', $credentials['username'])->first();

        if (!empty($account))
            if (Hash::check($credentials['password'], $account->password)) {
                session()->put('user', $account->username);
                session()->put('user_id', $account->user->id);
                session()->put('role', $account->user->role_id);

                if (session()->get('role') == 1 || session()->get('role') == 2)
                    return redirect('/admin');
                else
                    if (session()->get('role') == 3)
                        return redirect('/employee/table');
            } else {
                return redirect('/')->with('warning', 'Mật khẩu không chính xác!');
            }
        else {
            return redirect('/')->with('warning', 'Tài khoản không tồn tại!');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/')->with('warning', 'Đã đăng xuất tài khoản!');
    }
}
