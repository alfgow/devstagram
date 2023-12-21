@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="p-6 bg-white shadow md:w-1/2">
            <form action="{{route('perfil.store')}}" class="mt-10 md:mt-0" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="mb-5">
                        <label for="username" class="block mb-2 font-bold text-gray-500 uppercase">
                            Username
                        </label>
                        <input 
                        value="{{auth()->user()->username}}"
                        type="text" 
                        name="username" 
                        id="username" 
                        placeholder="Tu Nombre de usuario" 
                        class="w-full p-3 border rounded-lg 
                        @error('username')
                         border-red-500 
                        @enderror">
                        @error('username')
                            <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-5">
                    <label for="email" class="block mb-2 font-bold text-gray-500 uppercase">
                            email
                        </label>
                        <input 
                        value="{{auth()->user()->email}}"
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Tu email" 
                        class="w-full p-3 border rounded-lg 
                        @error('email')
                         border-red-500 
                        @enderror">
                        @error('email')
                            <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="imagen" class="block mb-2 font-bold text-gray-500 uppercase">
                            Imagen Perfil
                        </label>
                        <input 
                        value=""
                        type="file"
                        accept=".jpg, .jpeg, .png"
                        name="imagen" 
                        id="imagen" 
                        class="w-full p-3 border rounded-lg ">
                    </div>
                    <input type="submit" value="Guardar Cambios" class="w-full p-3 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-sky-600 hover:bg-sky-700">
            </form>
        </div>
    </div>
@endsection