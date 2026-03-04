<!doctype html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'AdvancedWebDev - Dota 2 Hub' }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        header { background: #111; color: #fff; padding: 12px 16px; }
        nav a { color: #fff; text-decoration: none; margin-right: 12px; }
        nav a:hover { text-decoration: underline; }
        main { padding: 16px; max-width: 900px; margin: 0 auto; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 16px; }
        footer { padding: 12px 16px; border-top: 1px solid #eee; color: #666; margin-top: 24px; }
    </style>
</head>

<body>
<header>
    <strong>Dota 2 Hub</strong>
    <nav style="display:inline-block; margin-left: 16px;">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/about') }}">About</a>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <small>&copy; {{ date('Y') }} Dota 2 Hub (Advanced Web Dev)</small>
</footer>
</body>
</html>