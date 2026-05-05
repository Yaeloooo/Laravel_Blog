<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

      <footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h3 class="text-white text-lg font-bold mb-4">MiMarca</h3>
          <p class="text-sm leading-6">
            Creando soluciones digitales increíbles desde 2026. La innovación es nuestro motor diario.
          </p>
        </div>
        <div class="flex flex-col space-y-2">
          <h4 class="text-white font-semibold mb-2">Enlaces</h4>
          <a href="#" class="hover:text-white transition text-sm">Privacidad</a>
          <a href="#" class="hover:text-white transition text-sm">Términos</a>
          <a href="#" class="hover:text-white transition text-sm">Soporte</a>
        </div>
        <div>
          <h4 class="text-white font-semibold mb-2">Suscríbete</h4>
          <div class="flex gap-2">
            <input type="email" placeholder="Email" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500 transition text-sm">Enviar</button>
          </div>
        </div>
      </div>

      <div class="mt-8 pt-8 border-t border-gray-800 text-center">
        <p class="text-xs">&copy; 2026 MiMarca Inc. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>
</html>
