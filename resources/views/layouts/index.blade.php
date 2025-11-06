<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <!-- Aquí puedes enlazar Bootstrap o estilos personalizados -->
</head>
<body>
    <header>
        <h1>Panel de Administración - Silvia Peluquería</h1>
    </header>

    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
