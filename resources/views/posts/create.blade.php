<x-app-layout>


    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow mt-10">
        <h1 class="text-2xl font-bold mb-6">Crear Nuevo Post</h1>

        <form action="/posts" method="POST">
            @csrf <!-- ¡IMPORTANTE! Sin esto Laravel da error 419 -->

            <div class="mb-4">
                <label class="block text-gray-700">Título</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Categoría</label>
                <select name="category" class="w-full border rounded p-2">
                    <option value="tecnologia">Tecnología</option>
                    <option value="programacion">Programación</option>
                    <option value="estilo_de_vida">Estilo de Vida</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Contenido</label>
                <textarea name="content" rows="5" class="w-full border rounded p-2" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Guardar Post
            </button>
        </form>
    </div>


</x-app-layout>
