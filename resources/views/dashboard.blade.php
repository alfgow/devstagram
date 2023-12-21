@extends('layouts.app')

@section('titulo')
    {{$user->username}}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="flex flex-col items-center w-full sm:w-6/12 sm:flex-row">
            <div class='w-8/12 px-5 lg:w-6/12'>
                <p><img src="{{ $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg')}}" alt="imagen usuario" class="rounded-full"></p>
            </div>
            <div class='flex flex-col items-center px-5 py-10 md:w-8/12 lg:w-6/12 md:justify-center md:py-10 sm:items-start'>
                {{-- <p class="mb-2 text-2xl text-gray-700">{{$user->username}}</p> --}}
              
                <p class="mb-3 text-sm font-bold text-gray-800">
                    {{$user->followers()->count()}}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers()->count())</span>
                </p>
                <p class="mb-3 text-sm font-bold text-gray-800">
                     {{$user->followings()->count()}}
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="mb-3 text-sm font-bold text-gray-800">
                    {{$user->posts->count()}}
                    <span class="font-normal">Posts</span>
                </p>
                @auth
           
                @if (auth()->user()->id !== $user->id )
                    @if ($user->siguiendo(auth()->user()))
                        <form action="{{route('users.unfollow', $user)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="px-3 py-1 text-sm font-bold text-white uppercase bg-red-600 rounded-lg cursor-pointer" value="unFollow">
                        </form>
                    @else
                        <form action="{{route('users.follow', $user)}}" method="POST">
                        @csrf
                        <input type="submit" class="px-3 py-1 text-sm font-bold text-white uppercase bg-blue-600 rounded-lg cursor-pointer" value="Follow">
                        </form>
                    @endif
                @else
                         <a href="{{route('perfil.index')}}" class='flex items-center gap-2 p-2 text-sm font-bold text-gray-600 bg-white border rounded cursor-pointer hover:text-gray-600'>
                            Editar Perfil
                    </a>               
                @endif
                @endauth
            </div>
        </div>        
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="my-10 text-4xl font-black text-center">Publicaciones</h2>
         <x-listar-post :posts="$posts"/>

    </section>
    
@endsection