const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// ─── CREAR ────────────────────────────────────────────────
async function createPost(formData) {
    const res = await fetch('/posts', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': CSRF,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData
    });

    if (!res.ok) {
        const err = await res.json();
        throw err;
    }

    return res.json();
}

// ─── ACTUALIZAR ───────────────────────────────────────────
async function updatePost(postId, formData) {
    formData.append('_method', 'PUT');

    const res = await fetch(`/posts/${postId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': CSRF,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData
    });

    if (!res.ok) {
        const err = await res.json();
        throw err;
    }

    return res.json();
}

// ─── ELIMINAR ─────────────────────────────────────────────
async function deletePost(postId) {
    const res = await fetch(`/posts/${postId}/delete`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': CSRF,
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json',
        },
    });

    if (!res.ok) throw await res.json();

    return res.json();
}
