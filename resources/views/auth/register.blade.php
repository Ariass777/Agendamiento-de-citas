<!doctype html>
<html lang="es">
  <head>
    <title>Registro | Silvia Peluquería</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">
  </head>

  <body>
    <section class="h-100" style="background-color: #eee;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">
                    <div class="text-center">
                      <img src="{{ asset('assets/logo.jpg') }}" style="width: 185px;" alt="logo">
                      <h4 class="mt-1 mb-5 pb-1">Bienvenido a Silvia Peluquería</h4>
                    </div>

                    <form action="{{ route('register') }}" method="POST">
                      @csrf

                      @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif

                      <p class="mb-4">Crear una nueva cuenta</p>

                      <div class="mb-4">
                        <label class="form-label" for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar nombre" required autocomplete="name" value="{{ old('name') }}">
                      </div>

                      <div class="mb-4">
                        <label class="form-label" for="email">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Ingresar correo" required autocomplete="email" value="{{ old('email') }}">
                      </div>

                      <div class="mb-4">
                        <label class="form-label" for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
                      </div>

                      <div class="mb-4">
                        <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
                      </div>

                      <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-primary btn-block gradient-custom-2 mb-3" type="submit">Registrarse</button>
                      </div>

                      <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">¿Ya tienes cuenta?</p>
                        <a href="{{route('login')}}" type="button" class="btn btn-black-hover">Iniciar sesion</a>



                      </div>
                    </form>
                  </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4">Silvia Peluquería</h4>
                    <p class="small mb-0">
                      Somos una peluquería dedicada a ofrecer el mejor servicio personalizado. Regístrate para reservar citas y disfrutar de promociones exclusivas.
                    </p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"></script>
  </body>
</html>

