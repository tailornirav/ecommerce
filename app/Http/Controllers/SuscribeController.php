<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SuscribeController extends Controller
{
    public function suscribe() {
        DB::table('suscribes')->insertOrIgnore([
            ['email' => $_GET['email']],
        ]);
        return redirect()->back();
    }
}
