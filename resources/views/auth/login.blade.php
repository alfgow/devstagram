@extends('layouts.app')

@section('titulo')
    Inicia sesión en DevStagram
@endsection

@section('contenido')
    <div class=" md:justify-center md:flex md:gap-10 md:items-center">
        <div class="p-5 md:w-6/12">
                <img src="{{asset('img/login.jpg')}}" alt="Imagen login de Usuarios" class="rounded-xl">
        </div>
        <div class="p-6 bg-white rounded-lg shadow-xl md:w-4/12">
                <form method="POST" action="{{route('login')}}" novalidate>
                    @csrf
                    @if (session('mensaje'))
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">
                            {{session('mensaje')}}
                        </p>
                    @endif
                    <div class="mb-5">
                        <label for="email" class="block mb-2 font-bold text-gray-500 uppercase">
                           email
                        </label>
                        <input type="email" value="{{old('email')}}" name="email" id="email" placeholder="me@me.com" class="w-full p-3 border rounded-lg @error('email')
                            border-red-500 
                        @enderror">
                        @error('email')
                            <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 font-bold text-gray-500 uppercase">
                            Password
                        </label>
                        <input type="password"  name="password" id="password" placeholder="Password" class="w-full p-3 border rounded-lg @error('password')
                            border-red-500 
                        @enderror">
                        @error('password')
                            <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                            <input
                                class="mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-red-500 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-red-500 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-gray-300 dark:after:bg-violet-700 dark:checked:bg-primary dark:checked:after:bg-green-700 dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                type="checkbox"
                                role="switch"
                                id="remember"
                                name="remember"
                            />
                            <label 
                                class="inline-block pl-[0.15rem] hover:cursor-pointer"
                                for="remember">
                                Mantener mi sesión activa
                            </label>
                    </div>
                    
                    <input type="submit" value="Iniciar Sesión" class="w-full p-3 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-sky-600 hover:bg-sky-700">
                </form>
        </div>
    </div>
@endsection