<x-app-layout>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Mis Posts</h1>

            {{-- ✅ Cambiado de <a href> a button con onclick --}}
            <button onclick="openCreateModal()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Nuevo Post
            </button>
        </div>

        {{-- ✅ Agregado id="posts-container" para manipularlo con JS --}}
        <div id="posts-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($posts as $post)

                {{-- ✅ Agregado data-id para identificar cada card --}}
                <div class="post-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition"
                    data-id="{{ $post->id }}">
                    <div class="p-6">

                        {{-- Categoría --}}
                        <span class="post-category inline-block px-3 py-1 text-xs font-semibold tracking-wider text-blue-800 uppercase bg-blue-100 rounded-full mb-4">
                            {{ $post->category }}
                        </span>

                        {{-- Título --}}
                        <h2 class="post-title text-xl font-bold text-gray-900 mb-2 leading-tight">
                            {{ $post->title }}
                        </h2>

                        {{-- Contenido --}}
                        <p class="post-content text-gray-600 mb-4 line-clamp-3">
                            {{ $post->content }}
                        </p>

                        {{-- Footer --}}
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-400">
                                {{ $post->created_at->format('d M, Y') }}
                            </span>
                            <a href="/posts/{{ $post->id }}"
                                class="text-blue-600 font-medium hover:text-blue-800 text-sm">
                                Leer más &rarr;
                            </a>
                        </div>

                        {{-- ✅ Botones de acción AJAX --}}
                        <div class="flex gap-2 mt-4 pt-4 border-t border-gray-100">
                            <button onclick="openEditModal(
                                        {{ $post->id }},
                                        '{{ addslashes($post->title) }}',
                                        '{{ addslashes($post->content) }}',
                                        '{{ addslashes($post->category) }}'
                                    )"
                                class="flex-1 bg-blue-50 text-blue-600 px-3 py-2 rounded-lg hover:bg-blue-100 text-sm font-medium transition">
                                ✏️ Editar
                            </button>
                            <button onclick="handleDelete({{ $post->id }})"
                                class="flex-1 bg-red-50 text-red-600 px-3 py-2 rounded-lg hover:bg-red-100 text-sm font-medium transition">
                                🗑️ Eliminar
                            </button>
                        </div>

                    </div>
                </div>

            @endforeach
        </div>

        {{-- Mensaje vacío --}}
        @if($posts->isEmpty())
            <div id="empty-message" class="text-center py-20">
                <p class="text-gray-500 text-xl">No hay posts creados todavía. ¡Crea el primero!</p>
            </div>
        @endif
    </div>

    {{-- ════════════════════════════════════════════════════════ --}}
    {{-- MODAL CREAR / EDITAR                                     --}}
    {{-- ════════════════════════════════════════════════════════ --}}
    <div id="post-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-2xl">

            <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-5">Nuevo Post</h2>

            {{-- ID oculto: vacío = crear | con valor = editar --}}
            <input type="hidden" id="editing-post-id">

            {{-- Título --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input id="post-title" type="text"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Título del post">
            </div>

            {{-- Categoría --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <input id="post-category" type="text"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ej: Tecnología, Gaming...">
            </div>

            {{-- Contenido --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                <textarea id="post-content" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Escribe tu post..."></textarea>
            </div>

            {{-- Errores de validación --}}
            <div id="form-errors"
                class="hidden bg-red-50 border border-red-200 rounded-lg p-3 mb-4 text-sm text-red-600">
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3">
                <button onclick="closeModal()"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button onclick="handleSubmit()"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                    Guardar
                </button>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════ --}}
    {{-- MODAL CONFIRMAR ELIMINAR                                 --}}
    {{-- ════════════════════════════════════════════════════════ --}}
    <div id="confirm-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl text-center">
            <div class="text-5xl mb-3">🗑️</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">¿Eliminar post?</h3>
            <p class="text-gray-500 text-sm mb-6">Esta acción no se puede deshacer.</p>
            <div class="flex gap-3 justify-center">
                <button onclick="closeConfirmModal()"
                    class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button id="confirm-delete-btn"
                    class="px-5 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
                    Sí, eliminar
                </button>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div id="toast"
        class="hidden fixed bottom-6 left-1/2 -translate-x-1/2 px-6 py-3 rounded-full shadow-lg z-50 text-white text-sm font-medium">
        <span id="toast-message"></span>
    </div>

    @push('scripts')
        <script src="{{ asset('js/posts.js') }}"></script>
        <script>

            // ─── MODAL CREAR / EDITAR ─────────────────────────────
            function openCreateModal() {
                document.getElementById('modal-title').textContent = 'Nuevo Post';
                document.getElementById('editing-post-id').value   = '';
                document.getElementById('post-title').value        = '';
                document.getElementById('post-category').value     = '';
                document.getElementById('post-content').value      = '';
                document.getElementById('form-errors').classList.add('hidden');
                document.getElementById('post-modal').classList.remove('hidden');
            }

            function openEditModal(id, title, content, category) {
                document.getElementById('modal-title').textContent = 'Editar Post';
                document.getElementById('editing-post-id').value   = id;
                document.getElementById('post-title').value        = title;
                document.getElementById('post-category').value     = category;
                document.getElementById('post-content').value      = content;
                document.getElementById('form-errors').classList.add('hidden');
                document.getElementById('post-modal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('post-modal').classList.add('hidden');
            }

            // ─── MODAL CONFIRMAR ELIMINAR ─────────────────────────
            let postIdToDelete = null;

            function handleDelete(postId) {
                postIdToDelete = postId;
                document.getElementById('confirm-modal').classList.remove('hidden');
                document.getElementById('confirm-delete-btn').onclick = confirmDelete;
            }

            function closeConfirmModal() {
                document.getElementById('confirm-modal').classList.add('hidden');
                postIdToDelete = null;
            }

            async function confirmDelete() {
                if (!postIdToDelete) return;

                try {
                    const data = await deletePost(postIdToDelete);

                    // Animación de salida
                    const card = document.querySelector(`[data-id="${postIdToDelete}"]`);
                    card.style.transition = 'opacity 0.3s, transform 0.3s';
                    card.style.opacity    = '0';
                    card.style.transform  = 'translateX(20px)';
                    setTimeout(() => card.remove(), 300);

                    closeConfirmModal();
                    showToast(data.message);

                } catch (err) {
                    closeConfirmModal();
                    showToast('Error al eliminar el post', true);
                }
            }

            // ─── SUBMIT (crear o editar) ──────────────────────────
            async function handleSubmit() {
                const postId = document.getElementById('editing-post-id').value;

                const formData = new FormData();
                formData.append('title',    document.getElementById('post-title').value);
                formData.append('content',  document.getElementById('post-content').value);
                formData.append('category', document.getElementById('post-category').value);

                try {
                    let data;

                    if (postId) {
                        // ── EDITAR: actualiza el DOM sin recargar ──
                        data = await updatePost(postId, formData);

                        const card = document.querySelector(`[data-id="${postId}"]`);
                        card.querySelector('.post-title').textContent    = data.post.title;
                        card.querySelector('.post-content').textContent  = data.post.content;
                        card.querySelector('.post-category').textContent = data.post.category;

                    } else {
                        // ── CREAR: inserta nueva card al inicio ──
                        data = await createPost(formData);

                        const empty = document.getElementById('empty-message');
                        if (empty) empty.remove();

                        document.getElementById('posts-container')
                            .insertAdjacentHTML('afterbegin', buildPostCard(data.post));
                    }

                    closeModal();
                    showToast(data.message);

                } catch (err) {
                    if (err.errors) {
                        const div = document.getElementById('form-errors');
                        div.innerHTML = Object.values(err.errors).flat().join('<br>');
                        div.classList.remove('hidden');
                    }
                }
            }

            // ─── CONSTRUIR CARD NUEVA ─────────────────────────────
            function buildPostCard(post) {
                // Formatea la fecha como "07 May, 2026"
                const fecha = new Date(post.created_at).toLocaleDateString('es-MX', {
                    day: '2-digit', month: 'short', year: 'numeric'
                });

                return `
                <div class="post-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition"
                    data-id="${post.id}">
                    <div class="p-6">
                        <span class="post-category inline-block px-3 py-1 text-xs font-semibold tracking-wider text-blue-800 uppercase bg-blue-100 rounded-full mb-4">
                            ${post.category}
                        </span>
                        <h2 class="post-title text-xl font-bold text-gray-900 mb-2 leading-tight">
                            ${post.title}
                        </h2>
                        <p class="post-content text-gray-600 mb-4 line-clamp-3">
                            ${post.content}
                        </p>
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-400">${fecha}</span>
                            <a href="/posts/${post.id}"
                                class="text-blue-600 font-medium hover:text-blue-800 text-sm">
                                Leer más &rarr;
                            </a>
                        </div>
                        <div class="flex gap-2 mt-4 pt-4 border-t border-gray-100">
                            <button onclick="openEditModal(${post.id}, '${post.title}', '${post.content}', '${post.category}')"
                                class="flex-1 bg-blue-50 text-blue-600 px-3 py-2 rounded-lg hover:bg-blue-100 text-sm font-medium transition">
                                ✏️ Editar
                            </button>
                            <button onclick="handleDelete(${post.id})"
                                class="flex-1 bg-red-50 text-red-600 px-3 py-2 rounded-lg hover:bg-red-100 text-sm font-medium transition">
                                🗑️ Eliminar
                            </button>
                        </div>
                    </div>
                </div>`;
            }

            // ─── TOAST ────────────────────────────────────────────
            function showToast(message, isError = false) {
                const toast = document.getElementById('toast');
                document.getElementById('toast-message').textContent = message;
                toast.className = `fixed bottom-6 left-1/2 -translate-x-1/2 px-6 py-3 
                                   rounded-full shadow-lg z-50 text-white text-sm font-medium
                                   ${isError ? 'bg-red-500' : 'bg-gray-800'}`;
                toast.classList.remove('hidden');
                setTimeout(() => toast.classList.add('hidden'), 3000);
            }

            // ─── CERRAR MODALES CLICKEANDO EL FONDO ──────────────
            document.getElementById('post-modal').addEventListener('click', function(e) {
                if (e.target === this) closeModal();
            });
            document.getElementById('confirm-modal').addEventListener('click', function(e) {
                if (e.target === this) closeConfirmModal();
            });

        </script>
    @endpush

</x-app-layout>
