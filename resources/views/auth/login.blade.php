<!doctype html>
<html lang="es">
<head>
    <title>Iniciar Sesión | Silvia Peluquería</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous" />
          
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">

    <style>
    /* ==================================== */
    /* Estilos CSS: Dark Theme y Responsive */
    /* ==================================== */

    body {
        background-color: #1a1a1a; 
        min-height: 100vh;
        
        /* === FONDO PERSONALIZADO === */
        /* Ruta a la imagen fondo.jpg en public/images */
        background-image: url('{{ asset('images/fondo.jpg') }}'); 
        
        background-size: cover; /* Cubre toda la pantalla */
        background-repeat: no-repeat;
        background-attachment: fixed; /* Mantiene el fondo fijo al hacer scroll */
        background-position: center center;
    }
    
    .login-section {
        min-height: 100vh; 
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 0; /* Padding vertical para evitar que el contenido se pegue en móviles */
    }
    
    .login-container {
        /* Fondo semi-transparente oscuro para mejor legibilidad */
        background-color: rgba(0, 0, 0, 0.85); 
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
        padding: 3rem 2rem;
        
        /* Control de ancho */
        max-width: 450px; 
        width: 90%; 
        margin: auto; 
        overflow: hidden;
    }
    
    /* Ajuste específico para pantallas más pequeñas (móviles) */
    @media (max-width: 576px) {
        .login-container {
            padding: 2rem 1.5rem; 
            max-width: 100%; 
            margin: 20px; 
        }
    }
    
    /* --- Estilos de Paleta y Elementos --- */
    
    .text-custom-gold {
        color: #d1b066; /* Dorado/Ocre */
    }
    
    .text-light-subtle {
        color: #aaa !important; /* Gris claro sutil */
    }

    /* Estilo para los campos de formulario oscuros */
    .form-control-dark {
        background-color: #222; 
        border: 1px solid #444; 
        color: white; 
        transition: border-color 0.3s;
    }

    .form-control-dark:focus {
        background-color: #222;
        border-color: #d1b066; 
        color: white;
        box-shadow: 0 0 0 0.25rem rgba(209, 176, 102, 0.25);
    }
    
    /* Estilo para el botón de iniciar sesión */
    .btn-gold {
        background-color: #d1b066;
        border-color: #d1b066;
        color: #1a1a1a; 
        font-weight: bold;
        padding: 10px 0;
        letter-spacing: 1.5px;
    }

    .btn-gold:hover {
        background-color: #c09f58; 
        border-color: #c09f58;
        color: #1a1a1a;
    }
</style>
</head>

<body>
    <section class="login-section">
        <div class="login-container text-white">
            <div class="text-center mb-5">
    <img src="{{ asset('images/logo.jpg') }}" 
         class="img-fluid" 
         style="max-width: 100px; border-radius: 50%;" 
         alt="Logo Silvia Peluquería">
    
    <h4 class="mt-3 text-light-subtle">Bienvenido a</h4>
    <h2 class="text-custom-gold mb-4">Silvia Peluquería</h2>
</div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label text-light-subtle" for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" 
                           class="form-control form-control-dark @error('email') is-invalid @enderror" 
                           placeholder=""
                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-light-subtle" for="password">Contraseña</label>
                    <input type="password" name="password" id="password" 
                           class="form-control form-control-dark @error('password') is-invalid @enderror" 
                           placeholder=""
                           required autocomplete="current-password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="text-center my-4">
                    <button class="btn btn-gold w-100" type="submit">INICIAR SESIÓN</button>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4 small">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" style="background-color: #222; border-color: #444;" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-light-subtle" for="remember">
                            Recordarme
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-custom-gold" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <div class="text-center mt-5">
                    <p class="text-light-subtle mb-1">¿No tienes cuenta?</p>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-custom-gold fw-bold">
                            Regístrate
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
</body>
</html>