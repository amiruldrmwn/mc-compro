import { store } from '@/routes/media';

function xsrfToken(): string {
    const match = document.cookie.match(/(?:^|; )XSRF-TOKEN=([^;]+)/);

    return match ? decodeURIComponent(match[1]) : '';
}

/**
 * Upload an image for a page section. Resolves to its stored path, or throws
 * with the server's message.
 */
export async function uploadImage(file: File): Promise<string> {
    const body = new FormData();
    body.append('file', file);

    const response = await fetch(store.url(), {
        method: 'POST',
        body,
        headers: {
            Accept: 'application/json',
            'X-XSRF-TOKEN': xsrfToken(),
        },
        credentials: 'same-origin',
    });

    const json = (await response.json().catch(() => ({}))) as {
        path?: string;
        message?: string;
    };

    if (!response.ok || !json.path) {
        throw new Error(json.message ?? 'Gambar gagal diunggah.');
    }

    return json.path;
}
