<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>  </title>

</head>



<div class="flex flex-col min-h-screen">

  <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex-shrink-0 flex items-center">
          <span class="text-2xl font-bold text-indigo-600">Mi<span class="text-gray-900">Marca</span></span>
        </div>

        <nav class="hidden md:flex space-x-8">
          <a href="/" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Inicio</a>
          <a href="/posts/create" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Crea Un Post</a>
          <a href="/posts/index" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Ver Los Post</a>
          <a href="" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Contacto</a>
        </nav>

        <div class="hidden md:block">
          <button class="bg-indigo-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
            Empezar
          </button>
        </div>

        <div class="md:hidden flex items-center">
          <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>

  {{$slot}}


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

</div>

</html>
