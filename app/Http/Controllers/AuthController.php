<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
     public function Logout(Request $request)
    {
        
        $request->session()->flush();
        return redirect('/index');
    }
}
