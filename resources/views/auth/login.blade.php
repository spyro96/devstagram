@extends('layouts.app')

@section('titulo')
    Inicia Sesión en DevsTagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center ">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg')}} " alt="imagen login">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Correo</label>
                    <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Tu correo de registro"
                    class="border p-3 w-full rounded @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}">

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Escribe tu contraseña"
                    class="border p-3 w-full rounded @error('password') border-red-500 @enderror">
                </div>
                @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror

                <input type="submit" value="Iniciar Sesión" class="bg-sky-600  hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 w-full text-white rounded-lg">
                <div class="mb-5 mt-5">
                    <input type="checkbox" id="remember" name="remember"> <label for="remember" class="text-sm text-gray-500">Mantener mi sesión abierta</label>
                </div>
            </form>
        </div>
    </div>
@endsection