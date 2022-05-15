<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

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
        FacadesSession::flash('success');
        FacadesSession::flash('title', 'Deslogado com sucesso!');
        FacadesSession::flash('msg', '');
        return redirect()->route('login');
    }

    public function autenticate(Request $request){

        if(isset($request->email) && !empty($request->email) && isset($request->password) && !empty($request->password)){
            $request->email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
            if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    return redirect()->route('dash');
                }else{
                    FacadesSession::flash('error');
                    FacadesSession::flash('title', 'Usuário inválido!');
                    FacadesSession::flash('msg', 'Verifique seu email e senha e tente novamente.');
                    return redirect()->route('login')->withInput();
                }
            }else{
                FacadesSession::flash('warning');
                FacadesSession::flash('title', 'Email inválido!');
                FacadesSession::flash('msg', 'Verifique o email digitado e tente novamente.');
                return redirect()->route('login')->withInput();
            }
        }else{
            FacadesSession::flash('warning');
            FacadesSession::flash('title', 'Campos vazios!');
            FacadesSession::flash('msg', 'Preencha os campos e tente novamente.');
            return redirect()->route('login')->withInput();
        }
    }
}
