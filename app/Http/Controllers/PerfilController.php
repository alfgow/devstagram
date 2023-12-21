<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(User $user)
    {
        return view('perfil.index',['user'=>$user,]);
    }

    // Revisar a profundidad este metodo, me puede servir para validar numeros telefonicos y correos que ya esten registrados en AS
    public function store(Request $request)
    {
        $request->request->add(['username'=>Str::slug($request->username)]);
        
        $rules = [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email'=>['required', 'unique:users,email,'.auth()->user()->id, 'email', 'max:60']
        ];
        $messages = [
            'username.unique'=>'El usuario "'.$request->username.'" ya está en uso',
        ];
        $this->validate($request, $rules, $messages);

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
            $imagenServidor = Image::make($imagen)->fit(1000,1000);
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        } 

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ??'';
        $usuario->save();

        //Redireccionamos al usuario
        return redirect()->route('posts.index', $usuario->username);
    }
}
