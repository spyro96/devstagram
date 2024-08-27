@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    placeholder="Nuevo nombre de usuario"
                    class="border p-3 w-full rounded @error('name') border-red-500 @enderror"
                    value="{{ old('username') }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Correo</label>
                    <input 
                    type="text" 
                    id="email" 
                    name="email" 
                    placeholder="Nuevo Correo"
                    class="border p-3 w-full rounded"
                    >
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                    <input 
                    type="file" 
                    id="imagen" 
                    name="imagen" 
                    accept=".jpg, .png, .jpge"
                    class="border p-3 w-full rounded"
                    >

                    <input type="submit" value="Guardar cambios" class="bg-sky-600 mt-3 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 w-full text-white rounded-lg">
                </div>
            </form>
        </div>
    </div>
@endsection