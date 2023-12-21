<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() 
    {
    return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        // dd($request->get('username'));

        //! Modificar el Request para tener la validation del username antes de enviar a la base de datos
        //?Importante no hacer esto a menos que no haya opcion

        $request->request->add(['username'=>Str::slug($request->username),]);

        //! Validación de Laravel
        $this->validate($request, [
            'name' => 'required|max:30',
            'username'=>'required|unique:users|max:20|min:3',
            'email'=>'required|unique:users|email|max:60',
            'password'=>'required|confirmed|min:6'
        ]);
        User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        //!Autenticar un usuario
        // auth()->attempt([
        //     'email'=>$request->email,
        //     'password' => $request->password
        // ]);

        //!Otra Forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        //Redireccionar
        return redirect()->route('posts.index');

    }
}
