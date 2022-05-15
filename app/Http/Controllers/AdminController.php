<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        $data = [
            'title' => 'Home',
            'user' => Auth::user(),
        ];
        return view('dashboard', $data);
    }
}
