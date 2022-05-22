<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = (new Usuario)->lazy()->all();
        $data = [
            'title' => 'Usuários',
            'usuarios' => $usuarios
        ];
        return view('usuarios.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Novo Usuário',
        ];
        return view('usuarios.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:255',
            'password' => 'required',
            'email' => 'required|email|unique:usuarios,email',
        ]);
        if ($validated) {
            $usuario = new Usuario();
            if (isset($request->foto_perfil)) {
                $usuario->foto_perfil = $request->file('foto_perfil')->store('avatars');
            } else {
                $usuario->foto_perfil = 'avatars/no-avatar.png';
            }
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->save();
            Session::flash('success', 'Usuário cadastrado com sucesso!');
            return redirect()->route('usuario.index');
        } else {
            return redirect()->route('usuario.create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        if (isset($usuario->id)) {
            $data = [
                'usuario' => $usuario,
                'title' => 'Editar Usuário ' . $usuario->nome,
            ];
            return view('usuarios.edit', $data);
        } else {
            Session::flash('err', 'Usuário não encontrado!');
            return redirect()->route('usuario.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($id) && intval($id) > 0) {
            $validated = $request->validate([
                'nome' => 'required|max:255',
                'email' => "required|email|unique:usuarios,email,$id",
            ]);
            if ($validated) {
                $usuario = Usuario::find($id);
                if (isset($request->foto_perfil)) {
                    $usuario->foto_perfil = $request->file('foto_perfil')->store('avatars');
                }
                $usuario->nome = $request->nome;
                $usuario->email = $request->email;
                if(isset($request->password)){
                    $usuario->password = Hash::make($request->password);
                }
                $usuario->save();
                Session::flash('success', 'Usuário alterado com sucesso!');
                return redirect()->route('usuario.index');
            }else{
                return redirect()->route('usuario.edit', $id);
            }
        } else {
            Session::flash('err', 'Usuário não encontrado!');
            return redirect()->route('usuario.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Usuario::find($id)->delete($id);
    }

    public function seed()
    {
        Usuario::factory()->count(5)->create();
        return redirect()->route('dash', 'debug');
    }
}
