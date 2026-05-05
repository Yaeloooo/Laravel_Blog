<x-app-layout>

    <h1>Editar Post</h1>


    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow mt-10">
        <h1 class="text-2xl font-bold mb-6">Editar Post</h1>

        {{-- En tu archivo edit.blade.php --}}
<form action="/posts/{{ $post->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-gray-700">Título</label>
        {{-- Agregamos value="{{ $post->title }}" para que el campo no aparezca vacío --}}
        <input type="text" name="title" value="{{ $post->title }}" class="w-full border rounded p-2" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Categoría</label>
        <select name="category" class="w-full border rounded p-2">
            <option value="tecnologia" {{ $post->category == 'tecnologia' ? 'selected' : '' }}>Tecnología</option>
            <option value="programacion" {{ $post->category == 'programacion' ? 'selected' : '' }}>Programación</option>
            <option value="estilo_de_vida" {{ $post->category == 'estilo_de_vida' ? 'selected' : '' }}>Estilo de Vida</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Contenido</label>
        <textarea name="content" rows="5" class="w-full border rounded p-2" required>{{ $post->content }}</textarea>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Actualizar Post
    </button>
</form>
    </div>


</x-app-layout>
