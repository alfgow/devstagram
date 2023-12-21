<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>Devstagram - @yield('titulo')</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
    </head>
    <body class="bg-gray-100">
        <header class="p-5 bg-white border-b shadow">
            <div class="container flex flex-col items-center justify-between mx-auto sm:flex-row">
                <a class="text-2xl font-black sm:text-3xl " href="{{route('home')}}">
                    DevStagram
                </a>
                @auth
                    <nav class="flex items-center gap-2">
                        <a href="{{route('post.create')}}" class='flex items-center gap-2 p-2 text-sm font-bold text-gray-600 bg-white border rounded'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            Post
                        </a>
                        <a class="text-sm font-bold text-gray-600 " href="{{route('posts.index', auth()->user()->username)}}">
                            Hola: <span class="font-normal">{{auth()->user()->username}}</span>
                        </a>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="p-1 text-sm font-bold text-white uppercase bg-red-500 border border-red-500 rounded-full" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-power" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 6a7.75 7.75 0 1 0 10 0" /><path d="M12 4l0 8" /></svg>
                            </button>
                        </form>
                        
                 
                    </nav>
                @endauth

                @guest
                    <nav class="flex items-center gap-2">
                        <a class="text-sm font-bold text-gray-600 uppercase" href="/login">Login</a>
                        <a class="text-sm font-bold text-gray-600 uppercase" 
                        href="{{route('register')}}">Crear Cuenta</a>
                    </nav>
                @endguest

                
            </div>
        </header>
        <main class="container mx-auto mt-10">
            <h2 class="mb-10 text-3xl font-black text-center">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>
        <Footer class="p-5 mt-10 font-bold text-center text-gray-600 uppercase">
            DevStagram - Todos los derechos reservados {{date('Y')}}
        </Footer>
        @livewireScripts
    </body>
</html>