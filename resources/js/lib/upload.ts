import { post } from '@/lib/http';
import { store } from '@/routes/media';

/**
 * Upload an image for a page section. Resolves to its stored path, or throws
 * with the server's message.
 */
export async function uploadImage(file: File): Promise<string> {
    const body = new FormData();
    body.append('file', file);

    const json = (await (await post(store.url(), body)).json()) as {
        path?: string;
    };

    if (!json.path) {
        throw new Error('Gambar gagal diunggah.');
    }

    return json.path;
}
