<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
    }
    public function logout()
    {
        Auth::logout();
        $notificiation = array(
            'message' => 'Admin Logout SuccessFully!',
            'alert-type' => 'success'
        );
        return redirect()->route('login')->with($notificiation);
    }
}
