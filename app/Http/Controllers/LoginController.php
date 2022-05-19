<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(){
        if(!Auth::check()){
            return view('login');
        }else{
            return redirect()->route('dash');
        }
    }

    public function logout(){
        Auth::logout();
        Session::flash('success');
        Session::flash('title', 'Deslogado com sucesso!');
        Session::flash('msg', '');
        return redirect()->route('login');
    }

    public function autenticate(Request $request){

        if(isset($request->email) && !empty($request->email) && isset($request->password) && !empty($request->password)){
            $request->email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
            if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    return redirect()->route('dash');
                }else{
                    Session::flash('error');
                    Session::flash('title', 'Usuário inválido!');
                    Session::flash('msg', 'Verifique seu email e senha e tente novamente.');
                    return redirect()->route('login')->withInput();
                }
            }else{
                Session::flash('warning');
                Session::flash('title', 'Email inválido!');
                Session::flash('msg', 'Verifique o email digitado e tente novamente.');
                return redirect()->route('login')->withInput();
            }
        }else{
            Session::flash('warning');
            Session::flash('title', 'Campos vazios!');
            Session::flash('msg', 'Preencha os campos e tente novamente.');
            return redirect()->route('login')->withInput();
        }
    }
}
