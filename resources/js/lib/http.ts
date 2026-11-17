function xsrfToken(): string {
    const match = document.cookie.match(/(?:^|; )XSRF-TOKEN=([^;]+)/);

    return match ? decodeURIComponent(match[1]) : '';
}

/**
 * POST to the admin with Laravel's CSRF cookie. Throws with the server's
 * message on a failed request.
 */
export async function post(
    url: string,
    body: FormData | object,
    accept: 'json' | 'html' = 'json',
): Promise<Response> {
    const isForm = body instanceof FormData;

    const response = await fetch(url, {
        method: 'POST',
        body: isForm ? body : JSON.stringify(body),
        headers: {
            Accept: accept === 'json' ? 'application/json' : 'text/html',
            ...(isForm ? {} : { 'Content-Type': 'application/json' }),
            'X-XSRF-TOKEN': xsrfToken(),
        },
        credentials: 'same-origin',
    });

    if (!response.ok) {
        const json = (await response.json().catch(() => ({}))) as {
            message?: string;
        };

        throw new Error(
            json.message ??
                (response.status === 429
                    ? 'Terlalu banyak permintaan. Tunggu sebentar.'
                    : 'Permintaan gagal. Coba lagi.'),
        );
    }

    return response;
}
