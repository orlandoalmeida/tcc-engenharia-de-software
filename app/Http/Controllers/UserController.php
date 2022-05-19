<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new User)->lazy()->all();
        $data = [
            'title' => 'Usuários',
            'users' => $users
        ];
        return view('users.index', $data);
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
        return view('users.create', $data);
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
            'name' => 'required|max:255',
            'password' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);
        if ($validated) {
            $user = new User();
            if (isset($request->profile_picture)) {
                $user->profile_picture = $request->file('profile_picture')->store('avatars');
            } else {
                $user->profile_picture = 'avatars/no-avatar.png';
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
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
        $user = User::find($id);
        if (isset($user->id)) {
            $data = [
                'user' => $user,
                'title' => 'Editar Usuário ' . $user->name,
            ];
            return view('users.edit', $data);
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
                'name' => 'required|max:255',
                'email' => "required|email|unique:users,email,$id",
            ]);
            if ($validated) {
                $user = User::find($id);
                if (isset($request->profile_picture)) {
                    $user->profile_picture = $request->file('profile_picture')->store('avatars');
                }
                $user->name = $request->name;
                $user->email = $request->email;
                if(isset($request->password)){
                    $user->password = Hash::make($request->password);
                }
                $user->save();
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
        User::find($id)->delete($id);
    }

    public function seed()
    {
        User::factory()->count(5)->create();
        return redirect()->route('dash');
    }
}
