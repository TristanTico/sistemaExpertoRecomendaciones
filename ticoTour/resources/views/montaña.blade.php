<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Agency - Start Bootstrap Theme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="{{ asset('assets/home.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="montaña" id="page-top">
  <!-- Navigation-->
  @include('body.nav')
   <!-- Masthead-->
   <header class="masthead">
    <div class="container">
        <div class="masthead-subheading">Bienvenidos!</div>
        <div class="masthead-heading text-uppercase">Un gusto para nosotros</div>
        <a class="btn btn-primary btn-xl text-uppercase" href="#services">Cuentame más</a>
    </div>
</header>

 <!-- Services-->
    <!-- Portfolio Grid-->
    <!-- resources/views/montaña.blade.php -->
    <section class="page-section bg-light" id="portfolio">
        <div class="container" style="background-color: #669900">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Montañas</h2>
                <h3 class="section-subheading text-muted">Cerros y Volcanes</h3>
            </div>
            <div class="row">
                @foreach ($montañas as $montaña)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal{{ $montaña->id }}">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="data:image/jpeg;base64,{{ base64_encode($montaña->imagen) }}"
                                    alt="{{ $montaña->nombre }}" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">{{ $montaña->nombre }}</div>
                                <div class="portfolio-caption-subheading text-muted">{{ $montaña->categoria }}</div>
                            </div>
                        </div>
                        <!-- Agregamos un contenedor oculto para la descripción -->
                        <div class="portfolio-description" id="descripcion{{ $montaña->id }}" style="display: none;">
                            {{ $montaña->descripcion }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    @foreach ($montañas as $montaña)
    <div class="portfolio-modal modal fade" id="portfolioModal{{ $montaña->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-uppercase">{{ $montaña->nombre }}</h2>
                    <p class="item-intro text-muted">{{ $montaña->categoria }}</p>
                    <img class="img-fluid" src="data:image/jpeg;base64,{{ base64_encode($montaña->imagen) }}" alt="{{ $montaña->nombre }}" />
                    <p>{{ $montaña->descripcion }}</p>

                    <button class="btn btn-success btn-like" data-playa-id="{{ $montaña->id }}">
                        <i class="fas fa-thumbs-up me-1"></i> Me gusta
                    </button>

                </div>
            </div>
        </div>
    </div>
@endforeach

 <!-- About-->

    <!-- Team-->
    <!-- @include('body.team') -->

    <!-- Contact-->
    <!-- Footer-->
    @include('body.footer')

    <!-- Antes de cerrar el body -->



    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>



</body>
</html>
