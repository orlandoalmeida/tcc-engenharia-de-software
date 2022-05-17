<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        $data = [
            'title' => 'Home',
            'user' => Auth::user(),
            'total_users' => (new User)->count(),
        ];
        return view('dashboard', $data);
    }
}
