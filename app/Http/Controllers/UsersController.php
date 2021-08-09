<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function register()
    {
        $user = \App\Models\User::where('email', '=', request(['email']))->first();
        if ($user === null) {
            $user = \App\Models\User::create(request(['name', 'email', 'password']));
            auth()->login($user);
            return redirect()->intended('/index');
        } else {
            return redirect()->intended('/account')->with([
                'alert' => 'Email alreay exists, please try loggin in'
            ]);
        }
    }

    public function login()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return redirect()->intended('/account')->with([
                'alert' => 'Invalid username or password!!'
            ]);
        }

        $url = str_replace(url('/'), '', url()->previous());

        if ($url === '/account') {
            return redirect()->intended('/');
        } else {
            return back();
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/index');
    }
}
