<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas | Silvia peluqueria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Paleta de colores: Fondo Negro Profundo (#121212) y Dorado de Lujo (#D4AF37) */
        body {
            background-color: #121212; /* Fondo oscuro elegante */
            color: #E0E0E0; /* Texto blanco grisáceo suave */
            font-family: 'Poppins', sans-serif;
        }
        
        /* HEADER - Estilo elegante y discreto */
        .header-bg {
            background-color: #0a0a0a; /* Negro aún más profundo para el encabezado */
            border-bottom: 1px solid #333;
        }
        .header-logo {
            width: 80px; /* Tamaño de logo más refinado */
            height: 80px;
            border-radius: 50%; /* Logo circular */
            object-fit: cover;
            border: 2px solid #D4AF37; /* Borde dorado de acento */
        }
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 20px;
        }
        .header-schedule {
            color: #AAAAAA; /* Gris suave para el horario */
            font-size: 0.85rem;
            text-align: right;
            padding-left: 20px;
            line-height: 1.4;
        }
        
        /* MAIN CONTENT - Estructura de Flexbox */
        .container-main {
            display: flex;
            justify-content: center; /* Centrar todo el contenido */
            align-items: flex-start; /* Alinear arriba */
            padding: 60px 20px;
            gap: 50px; /* Espacio entre las secciones */
            flex-wrap: wrap;
        }
        
        .left-section {
            flex-basis: 350px; /* Ancho fijo para la sección de botones */
            text-align: center;
        }
        
        .right-section {
            flex-basis: 550px; /* Ancho fijo para el carrusel y la tienda */
            max-width: 100%;
            display: flex; /* Añadido para apilar carrusel y tienda */
            flex-direction: column; /* Añadido para apilar carrusel y tienda */
            gap: 40px; /* Espacio entre el carrusel y la tienda */
        }

        /* TÍTULO PRINCIPAL */
        .main-title {
            color: #D4AF37; /* Dorado de lujo */
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: 0 0 5px rgba(212, 175, 55, 0.5); /* Sombra sutil dorada */
        }
        
        /* BOTONES DE ACCIÓN */
        .btn-luxury {
            display: block;
            width: 100%;
            margin: 20px auto;
            background-color: #7d4833; /* Marrón elegante */
            color: white;
            font-weight: 600;
            border: 2px solid #5a3324;
            padding: 18px;
            border-radius: 6px;
            font-size: 1.1rem;
            letter-spacing: 1px;
            transition: background-color 0.3s, transform 0.2s, border-color 0.3s;
            text-decoration: none; /* Asegura que no haya subrayado */
        }
        .btn-luxury:hover {
            background-color: #92543e; /* Tono más claro al pasar el ratón */
            border-color: #D4AF37; /* Borde dorado en hover */
            transform: translateY(-2px); /* Efecto 3D sutil */
            color: white;
        }

        /* --- ESTILOS DEL CARRUSEL ELEGANTES --- */
        .carousel-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px; 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
            border: 1px solid #333; /* Borde sutil */
        }
        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-slide {
            min-width: 100%;
            height: 450px; /* Altura ligeramente aumentada */
            position: relative;
        }
        .carousel-slide img {
            width: 100%;
            height: 100%; /* Asegura que la imagen cubra la altura del slide */
            object-fit: cover;
            display: block;
        }
        .carousel-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0) 100%);
            padding: 2rem 1.5rem 1rem;
            text-align: left;
        }
        .carousel-caption h4 {
            font-size: 1.5rem;
            color: #D4AF37; /* Dorado */
            text-shadow: 1px 1px 2px #000;
        }
        .carousel-caption p {
            color: #ccc;
        }
        .carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(212, 175, 55, 0.7); /* Dorado semitransparente */
            color: #121212; /* Ícono negro en botón dorado */
            border: none;
            padding: 0.75rem 1rem;
            cursor: pointer;
            z-index: 10;
            transition: background 0.3s;
            border-radius: 5px; /* Cuadrado con bordes redondeados */
            opacity: 0.8;
        }
        .carousel-button.left { left: 15px; }
        .carousel-button.right { right: 15px; }
        .carousel-button:hover {
            background: #D4AF37; /* Dorado sólido en hover */
            opacity: 1;
        }
        
        /* --- NUEVA SECCIÓN DE TIENDA DE PRODUCTOS --- */
        .product-shop-section {
            background-color: #1c1c1c; /* Fondo ligeramente más claro que el body */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            border: 1px solid #333;
            text-align: center;
        }
        .product-shop-section h3 {
            color: #D4AF37; /* Dorado */
            font-size: 1.8rem;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .product-shop-section p {
            color: #ccc;
            font-size: 1rem;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        /* Estilo específico para el botón de la tienda, ajustando el margen superior */
        .product-shop-section .btn-luxury {
            margin-top: 0; 
        }

        /* FOOTER */
        footer {
            background-color: #0a0a0a;
            color: #555;
            padding: 20px 0;
            font-size: 0.8rem;
            border-top: 1px solid #333;
            text-align: center; /* Centrar el texto del footer */
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .container-main {
                flex-direction: column;
                align-items: center;
                padding: 30px 20px;
            }
            .left-section, .right-section {
                flex-basis: 100%;
                padding: 0;
                margin-bottom: 40px;
                width: 100%; /* Asegura que ocupen todo el ancho disponible */
            }
            .main-title {
                font-size: 2rem;
            }
            .product-shop-section {
                padding: 20px;
            }
            .product-shop-section h3 {
                font-size: 1.5rem;
            }
        }
        
    </style>
</head>
<body>

    <header class="header-bg">
        <div class="header-content">
            
            <img src="{{ asset('images/logo.jpg') }}" 
                alt="Logo Silvia Peluquería" 
                class="header-logo">
            
            <p class="header-schedule">
                <i class="far fa-clock text-warning me-1"></i>
                HORARIOS DE ATENCIÓN:
                <br>
                Domingo a domingo, 8:00 AM - 9:00 PM
            </p>

        </div>
    </header>

    <div class="container-main">
        <div class="left-section">
            <h2 class="main-title">Sistema de Reservas en Línea</h2>
            
            <a href="{{ route('agendar.create') }}" class="btn-luxury">
                <i class="fas fa-calendar-alt me-2"></i>
                RESERVA AQUÍ TU CITA
            </a>
            <a href="#" class="btn-luxury">
                <i class="fas fa-edit me-2"></i>
                EDITAR O CANCELAR CITA
            </a>
            
            <div class="mt-5 p-3" style="border: 1px solid #333; border-radius: 8px; background-color: #1c1c1c;">
                <p class="text-warning warning-title m-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Información Importante
                </p>
                <p class="text-white-50 mt-2 mb-0" style="font-size: 0.9rem;">
                    Por favor, llega 5 minutos antes de tu hora reservada. Las cancelaciones deben hacerse con al menos 2 horas de antelación.
                </p>
            </div>
        </div>

        <div class="right-section">
            <div class="carousel-container" id="barber-carousel">
                <div class="carousel-track">
                    
                    <div class="carousel-slide">
                        <img src="{{asset('images/motilar.jpg')}}" alt="Corte de cabello profesional"> 
                        <div class="carousel-caption">
                            <h4>Cortes de Cabello Exclusivos</h4>
                            <p>Dominamos todos los estilos, desde clásicos hasta modernos, con la máxima precisión.</p>
                        </div>
                    </div>

                    <div class="carousel-slide">
                        <img src="{{asset('images/uñas.jpg')}}" alt="Servicio de cuidado de uñas"> 
                        <div class="carousel-caption">
                            <h4>Manicure & Pedicure Premium</h4>
                            <p>Tratamientos de lujo para el cuidado y embellecimiento de manos y pies.</p>
                        </div>
                    </div>
                    
                    <div class="carousel-slide">
                        <img src="{{asset('images/capilar.jpg')}}" alt="Tratamientos capilares y spa"> 
                        <div class="carousel-caption">
                            <h4>Spa y Tratamientos Capilares</h4>
                            <p>Revitaliza tu cabello con productos de alta gama y técnicas especializadas.</p>
                        </div>
                    </div>

                </div>

                <button class="carousel-button left" onclick="moveCarousel(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-button right" onclick="moveCarousel(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            
            <div class="product-shop-section">
                <h3>Nuestra Tienda de Productos para el Cabello</h3>
                <p>Descubre nuestra exclusiva línea para un cabello radiante. <br>¡Encuentra los tratamientos perfectos para ti!</p>
                <a href="/tienda" class="btn-luxury"> 
    <i class="fas fa-shopping-cart me-2"></i>
    Ver Productos y Comprar
</a>
            </div>
            </div>
    </div>

    <footer>
        <div class="container">
            © 2025 Silvia Peluquería — Todos los derechos reservados
        </div>
    </footer>

    <script>
        // Inicialización dentro de DOMContentLoaded para asegurar que todos los elementos existan
        document.addEventListener('DOMContentLoaded', () => {
            const carousel = document.getElementById('barber-carousel');
            if (!carousel) return; // Salir si el carrusel no existe
            
            const track = carousel.querySelector('.carousel-track');
            const slides = Array.from(carousel.querySelectorAll('.carousel-slide')); 
            const slideCount = slides.length;
            let currentIndex = 0;

            // Función para mover el carrusel
            window.moveCarousel = function(direction) {
                currentIndex = (currentIndex + direction + slideCount) % slideCount;
                const offset = -currentIndex * 100;
                track.style.transform = `translateX(${offset}%)`;
            }

            // Movimiento automático
            setInterval(() => {
                window.moveCarousel(1);
            }, 5000); // Cambia de imagen cada 5 segundos
        });

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

</body>
</html>