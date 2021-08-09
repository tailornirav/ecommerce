<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contact() {
        DB::table('contacts')->insertOrIgnore([
            'name' => $_GET['name'],
            'email' => $_GET['email'],
            'phone' => $_GET['phone'],
            'subject' => $_GET['subject'],
            'message' => $_GET['message'],

        ]);
        return redirect()->intended('/')->with([
            'alert' => 'Your request has been successfully placed. You will we contacted ASAP.'
        ]);
    }
}
