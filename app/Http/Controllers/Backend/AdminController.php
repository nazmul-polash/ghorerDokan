<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(){
        return view('backend.admin_auth.login');
    }

    public function register(){
        return view('backend.admin_auth.register');
    }
}
