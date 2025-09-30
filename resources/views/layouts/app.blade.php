<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>El Rincón Mágico</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJz9C3aR/6p/F+2T5L/K7G5J2JvG9h7/1X7w/W7C2K5r7r7A7K7I7G7L7L7L7L7L7L7" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Playfair+Display:400,700|Nunito:400,600,700" rel="stylesheet">
    
    
    @vite(['resources/js/app.js'])

    <style>
        :root {
            --color-soft-black: #1a1a1a; 
            --color-gold-accent: #AF803E; 
            --color-turquoise-accent: #00A9A5; 
            --color-olive: #5A7247; 
            --color-bg-light: #F8F8F8; 
            --color-text-dark: #222222; 
            --color-text-light: #dddddd;
            --transition-speed: 0.3s;
        }

        body {
            background-color: var(--color-bg-light);
            font-family: 'Nunito', sans-serif;
            color: var(--color-text-dark);
        }

       
        h1, h2, h3, .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        
        .navbar-elegant {
            background-color: var(--color-soft-black);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--color-gold-accent) !important; 
        }

        
        .nav-link {
            color: var(--color-text-light) !important;
            font-weight: 400;
            padding: 0.5rem 1rem !important;
            transition: all var(--transition-speed) ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--color-gold-accent) !important; 
            border-bottom: 2px solid var(--color-gold-accent);
            padding-bottom: 0.3rem !important;
        }
        
        
        .btn-gold {
            background-color: var(--color-gold-accent);
            color: white !important;
            border: 1px solid var(--color-gold-accent);
            font-weight: 600;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(175, 128, 62, 0.2);
            transition: background-color var(--transition-speed), transform var(--transition-speed);
        }

        .btn-gold:hover {
            background-color: #9c6c31; 
            transform: translateY(-1px);
            color: white !important;
        }

        
        .btn-turquoise {
            background-color: var(--color-turquoise-accent);
            color: var(--color-soft-black) !important; 
            border: 1px solid var(--color-turquoise-accent);
            font-weight: 600;
            border-radius: 0.5rem;
            transition: background-color var(--transition-speed);
        }

        .btn-turquoise:hover {
            background-color: #008f8b;
        }

        
        .footer-elegant {
            background-color: var(--color-soft-black);
            color: var(--color-text-light); 
        }
    </style>
</head>
<body>
    
    <div id="app" class="d-flex flex-column min-vh-100"> 
        
        <nav class="navbar navbar-expand-lg navbar-dark navbar-elegant mb-5">
            <div class="container">
                
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-feather me-2"></i> El Rincón Mágico
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}"><i class="fas fa-book-open me-1"></i> Catálogo</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart me-1"></i> Carrito</a></li>
                        
                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-receipt me-1"></i> Mis pedidos</a></li>
                            
                            <li class="nav-item"><a class="nav-link" href="{{ route('profile.index') }}"><i class="fas fa-id-card me-1"></i> Perfil</a></li>
                            @if(Auth::user()->is_admin)
                                
                                <li class="nav-item"><a class="nav-link" style="color: var(--color-olive) !important;" href="{{ route('admin.dashboard') }}"><i class="fas fa-user-shield me-1"></i> Administración</a></li>
                            @endif
                        @endauth
                    </ul>

                    
                    <ul class="navbar-nav d-flex align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item me-2">
                                    
                                    <a class="btn btn-sm btn-outline-light rounded-pill" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Iniciar Sesión</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    
                                    <a class="btn btn-sm btn-gold" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i> Registrarse</a>
                                </li>
                            @endif
                        @endguest

                        @auth
                            
                            <span class="fw-semibold me-3" style="color: var(--color-gold-accent);">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </span>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-turquoise rounded-pill">
                                    <i class="fas fa-power-off me-1"></i> Salir
                                </button>
                            </form>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        
        
        <main class="py-5 flex-grow-1">
            <div class="container">
                @yield('content')
            </div>
        </main>
        
        <
        <footer class="mt-auto py-4 footer-elegant">
            <div class="container text-center">
                <small class="d-block mb-2">
                    
                    <i class="fas fa-stamp me-1" style="color: var(--color-gold-accent);"></i> Colección Literaria &copy; {{ date('Y') }} El Rincón Mágico
                </small>
                <div class="mb-2">
                    
                    <a href="#" class="mx-2 text-decoration-none" style="color: var(--color-turquoise-accent);"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="mx-2 text-decoration-none" style="color: var(--color-turquoise-accent);"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="mx-2 text-decoration-none" style="color: var(--color-turquoise-accent);"><i class="fab fa-instagram"></i></a>
                </div>
                <small class="text-secondary">Universo de la lectura. Todos los derechos reservados.</small>
            </div>
        </footer>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>