<x-app-layout>

    <h1 class="text-3xl font-bold text-center mt-10">Bienvenido al Blog</h1>

    <!-- Rejilla de Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition">
                <div class="p-6">

                    {{-- Usuario --}}
                    {{-- En tu archivo home.blade.php --}}
                    <span class="inline-block px-3 py-1 text-xs font-semibold ...">
                        <div>{{ $post->user?->name ?? 'Usuario no encontrado' }}</div>
                    </span>


                    <!-- Categoría con Badge -->
                    <span
                        class="inline-block px-3 py-1 text-xs font-semibold tracking-wider text-blue-800 uppercase bg-blue-100 rounded-full mb-4">
                        {{ $post->category }}
                    </span>

                    <!-- Título -->
                    <h2 class="text-xl font-bold text-gray-900 mb-2 leading-tight">
                        {{ $post->title }}
                    </h2>

                    <!-- Contenido Corto -->
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ $post->content }}
                    </p>

                    <!-- Footer de la Card -->
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-50">
                        <span class="text-sm text-gray-400">
                            {{ $post->created_at->format('d M, Y') }}
                        </span>
                        <a href="/posts/{{ $post->id }}"
                            class="text-blue-600 font-medium hover:text-blue-800 text-sm">
                            Leer más &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($posts->isEmpty())
        <div class="text-center py-20">
            <p class="text-gray-500 text-xl">No hay posts creados todavía. ¡Crea el primero!</p>
        </div>
    @endif
    </div>


</x-app-layout>
