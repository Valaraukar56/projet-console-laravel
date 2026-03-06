<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Urthel') }}</title>

    <script>(function(){const t=localStorage.getItem('theme')||'light';document.documentElement.setAttribute('data-bs-theme',t);})();</script>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        .console-card {
            transition: transform 0.2s;
        }
        .console-card:hover {
            transform: translateY(-5px);
        }
        .condition-badge {
            font-size: 0.75rem;
        }
        .navbar-brand {
            font-weight: bold;
        }
        footer {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            border-color: var(--bs-border-color) !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-controller"></i> Urthel
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('consoles.index') }}">
                                <i class="bi bi-grid"></i> Toutes les consoles
                            </a>
                        </li>
                        @auth
                            @role('admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('consoles.create') }}">
                                    <i class="bi bi-plus-circle"></i> Ajouter une console
                                </a>
                            </li>
                            @endrole
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <button id="theme-toggle" class="btn btn-link nav-link px-2" title="Changer le thème">
                                <i class="bi bi-moon-stars" id="theme-icon"></i>
                            </button>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    <i class="bi bi-cart"></i> Panier
                                </a>
                            </li>
                        @endauth

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                    @role('admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @endrole
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer class="border-top py-4 mt-5">
            <div class="container text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Urthel - Vente de consoles de jeux</p>
                @auth
                    @role('admin')
                    <div class="mt-3">
                        <span class="text-muted me-2">Admin :</span>
                        <a href="http://glpi.local" target="_blank" class="btn btn-outline-secondary btn-sm me-2">
                            <i class="bi bi-gear"></i> GLPI
                        </a>
                        <a href="http://localhost/phpmyadmin" target="_blank" class="btn btn-outline-secondary btn-sm me-2">
                            <i class="bi bi-database"></i> phpMyAdmin
                        </a>
                        <a href="{{ asset('docs/index.html') }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-file-earmark-code"></i> Documentation
                        </a>
                    </div>
                    @endrole
                @endauth
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggle = document.getElementById('theme-toggle');
        const icon = document.getElementById('theme-icon');

        function applyTheme(theme) {
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            icon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
        }

        const current = document.documentElement.getAttribute('data-bs-theme') || 'light';
        icon.className = current === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';

        toggle.addEventListener('click', () => {
            const next = document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
            applyTheme(next);
        });
    </script>
</body>
</html>
