<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; font-family: system-ui, sans-serif; background: #f8fafc; color: #0f172a; }
        main { text-align: center; padding: 24px; }
        a { color: #2563eb; }
    </style>
</head>
<body>
    <main>
        <h1>Website sedang disiapkan</h1>
        <p>Pemilik website dapat masuk ke <a href="{{ url('/admin') }}">panel admin</a>.</p>
    </main>
</body>
</html>
