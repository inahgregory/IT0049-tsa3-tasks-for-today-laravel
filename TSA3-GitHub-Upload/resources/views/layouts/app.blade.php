<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tasks for Today, a personal task directory by Inah Angela Gregorio.">
    <title>@yield('title') | Tasks for Today</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<a class="skip" href="#main">Skip to content</a>
<header class="site-header">
    <div class="shell topbar">
        <a class="brand" href="{{ route('welcome') }}"><span class="brand-icon" aria-hidden="true">&#10003;</span> Tasks for Today<span class="brand-dot">.</span></a>
        <nav aria-label="Main navigation">
            @foreach (['welcome' => 'Welcome', 'tasks' => 'Task List', 'profile' => 'Profile', 'about' => 'About'] as $route => $label)
            <a href="{{ route($route) }}" @class(['nav-link', 'active' => request()->routeIs($route)]) @if(request()->routeIs($route)) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
        </nav>
    </div>
</header>
<main id="main" class="shell">@yield('content')</main>
<footer class="shell site-footer"><span>Tasks for Today &middot; A little clarity, every day.</span><span>Inah Angela Gregorio &middot; IT0049 TSA3</span></footer>
</body>
</html>
