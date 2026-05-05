<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <a href="/posts/index" class="text-blue-600 hover:underline text-sm font-medium">
                &larr; Volver al listado
            </a>
        </div>

        <!-- Card Única Detallada -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-8">
                <!-- Categoría -->
                <span class="inline-block px-3 py-1 text-xs font-semibold tracking-wider text-blue-800 uppercase bg-blue-100 rounded-full mb-4">
                    {{ $post->category }}
                </span>

                <!-- Título -->
                <h1 class="text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                    {{ $post->title }}
                </h1>

                <!-- Fecha -->
                <div class="text-sm text-gray-400 mb-6">
                    Publicado el {{ $post->created_at->format('d M, Y') }}
                </div>

                <!-- Contenido Completo -->
                <div class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">
                    {{ $post->content }}
                </div>

                @if (auth()->id() === $post->user_id)
                    <form action="/posts/{{ $post->id }}/delete" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Eliminar Post
                        </button>
                    </form>
                @endif


            </div>
        </div>
    </div>
</x-app-layout>
