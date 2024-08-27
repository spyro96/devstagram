<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')<!-- la directiva de stack permite agregar hojas de estilos que no se requieran en todas la vistas, tambien valido para el javascript-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Devstagram - @yield('titulo')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @livewireStyles
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black">
                DevsTagram
            </a>

            @auth
            <nav class="flex flex-col mt-4 md:flex-row md:mt-0 gap-2 items-center">
                <a href="{{route('post.create')}}" class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                      </svg>
                      
                    Crear</a>
                <a href="{{ route('post.index', auth()->user()->username)}}" class="font-bold text-gray-600 text-sm">
                    Hola: <span class="font-normal"> {{ auth()->user()->username }} </span>    
                </a>
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar Sesión</button>
                </form>
            </nav>  
            @endauth

            @guest
            <nav class="flex gap-2 items-center">
                <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm">Crear Cuenta</a>
            </nav>  
            @endguest  
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>

    <footer class="text-center p-5 text-gray-500 font-bold uppercase">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>

    @livewireScripts
</body>

</html>