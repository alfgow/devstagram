@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{asset('uploads'). '/' . $post->imagen}}" alt="Imagen del Post {{$post->titulo}}">
            <div class="flex items-center gap-4 p-3 ">
                @auth

                <livewire:like-post :post="$post"  />
                
                @endauth
                
            </div>
            <div>
                <p class="font-bold">
                    {{$post->user->username}}
                </p>
                <p class="text-sm text-gray-500">
                    {{$post->created_at->diffForHumans()}}
                </p>
                <p class="mt-5">
                    {{$post->descripcion}}
                </p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{route('posts.destroy', $post)}}" >
                        @method('DELETE')
                        @csrf
                    <input 
                        type="submit" 
                        value="Eliminar Publicacion"
                        class="p-2 mt-4 font-bold text-white bg-red-500 rounded-lg cursor-pointer hover:bg-red-600"
                    >
                </form>
                @endif
            @endauth
        </div>
        <div class="p-5 md:w-1/2">
            <div class="p-5 mb-5 bg-white shadow">
                @auth
                <p class="mb-4 text-xl font-bold text-center">
                    Agrega un nuevo comentario
                </p>
                @if (session('mensaje'))
                    <div class="p-2 mb-6 font-bold text-center text-white uppercase bg-green-500 rounded-lg">
                        {{session('mensaje')}}
                    </div>
                @endif
                <form action="{{route('comentarios.store', ['post'=>$post, 'user'=>$user])}}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="block mb-2 font-bold text-gray-500 uppercase">
                            Que estás pensando?
                        </label>
                        <textarea 
                        name="comentario" 
                        id="comentario" 
                        placeholder="Agrega un comentario" 
                        class="w-full p-3 border rounded-lg 
                        @error('comentario')
                         border-red-500 
                        @enderror"></textarea>   
                        @error('comentario')
                            <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}
                            </p>
                        @enderror
                    </div>
                    <input type="submit" value="Comentar" class="w-full p-3 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-sky-600 hover:bg-sky-700">
                </form>
                @endauth

                <div class="mt-10 mb-5 overflow-y-scroll bg-white shadow max-h-96">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="relative grid grid-cols-1 gap-4 p-4 m-8 bg-white border rounded-lg shadow-lg">
                                <div class="relative flex gap-4">
                                    <a href="{{route('posts.index', $comentario->user)}}" target="_blank" class="">
                                    <img src="{{$comentario->user->imagen ? asset('perfiles').'/'.$comentario->user->imagen : 'https://icons.iconarchive.com/icons/iconarchive/dog-breed/128/Pug-icon.png'}}" class="relative w-20 h-20 m-1 -mb-4 bg-white border rounded-lg -top-8" alt="" loading="lazy">
                                    </a>
                                    <div class="flex flex-col w-full">
                                        <div class="flex flex-row justify-between">
                                            <a href="{{route('posts.index', $comentario->user)}}" class="relative overflow-hidden text-xl font-bold truncate whitespace-nowrap" target="_blank">{{$comentario->user->username}}</a>
                                            <a class="text-xl text-gray-500" href="#"><i class="fa-solid fa-trash"></i></a>
                                        </div>
                                        <p class="text-sm text-gray-400">{{$comentario->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                                <p class="-mt-4 text-gray-500">{{$comentario->comentario}}</p>
                                
                            </div>
                                
                        @endforeach
                    @else
                        <p class="p-10 text-center">
                            Nadie ha comentado
                        </p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
    
@endsection

