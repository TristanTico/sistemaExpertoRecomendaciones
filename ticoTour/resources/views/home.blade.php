<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Tico Tour Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{asset('assets/home.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/toastr.min.css') }}">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iKSeLeMzXJF3eDJPJ2CBpd0+2Dz+td2EnfddF83/3Zj47EJVoUpFhNIlM" crossorigin="anonymous">

    </head>
    <body class="home"   id="page-top" >
        <div>
        @include('body.nav')
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Bienvenidos sean!</div>
                <div class="masthead-heading text-uppercase">Es un gusto para nosotros</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Cuentame mas</a>
            </div>
        </header>

        @php
                        
        $user = auth()->user();
        $tienePreferencias = \App\Models\Preferencias::where('user_id', $user->id)->exists();
        @endphp

        @if(!$tienePreferencias)
        <section class="page-section">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Preferencias</h2>
            <h3 class="section-subheading">Por favor elige la categoría que prefieras</h3>
        </div>

        <form id="form-preferencias">
            @csrf
            <div class="form-group">
                <label for="categoria">Selecciona una categoría</label>
                <select name="categoria_seleccionada" id="categoria" class="form-control">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->nombre }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="button" id="btn-guardar-preferencias" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</section>
@endif
        <!-- Services-->
        @include('body.services')

        @if($tienePreferencias)
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tus preferencias</h2>
                </div>
                <div class="row">
                @foreach ($preferencias as $preferencia)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal{{ $preferencia->id }}">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="data:image/jpeg;base64,{{ base64_encode($preferencia->imagen) }}"
                                    alt="{{ $preferencia->nombre }}" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">{{ $preferencia->nombre }}</div>
                                <div class="portfolio-caption-subheading text-muted">{{ $preferencia->categoria }}</div>
                            </div>
                        </div>
                        <!-- Agregamos un contenedor oculto para la descripción -->
                        <div class="portfolio-description" id="descripcion{{ $preferencia->id }}" style="display: none;">
                            {{ $preferencia->descripcion }}
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </section>
        @endif

        @foreach ($preferencias as $preferencia)
    <div class="portfolio-modal modal fade" id="portfolioModal{{ $preferencia->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-uppercase">{{ $preferencia->nombre }}</h2>
                    <p class="item-intro text-muted">{{ $preferencia->categoria }}</p>
                    <img class="img-fluid" src="data:image/jpeg;base64,{{ base64_encode($preferencia->imagen) }}" alt="{{ $preferencia->nombre }}" />
                    <p>{{ $preferencia->descripcion }}</p>

                    <button class="btn btn-success btn-like" data-playa-id="{{ $preferencia->id }}">
                        <i class="fas fa-thumbs-up me-1"></i> Me gusta
                    </button>

                </div>
            </div>
        </div>
    </div>
    @endforeach


    <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tus Recomendaciones</h2>
                </div>
                <div class="row">
                @foreach ($recomendaciones as $recomendacione)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal{{ $recomendacione->id }}">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="data:image/jpeg;base64,{{ base64_encode($recomendacione->imagen) }}"
                                    alt="{{ $recomendacione->nombre }}" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">{{ $recomendacione->nombre }}</div>
                                <div class="portfolio-caption-subheading text-muted">{{ $recomendacione->categoria }}</div>
                            </div>
                        </div>
                        <!-- Agregamos un contenedor oculto para la descripción -->
                        <div class="portfolio-description" id="descripcion{{ $recomendacione->id }}" style="display: none;">
                            {{ $recomendacione->descripcion }}
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </section>

        @foreach ($recomendaciones as $recomendacione)
    <div class="portfolio-modal modal fade" id="portfolioModal{{ $recomendacione->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-uppercase">{{ $recomendacione->nombre }}</h2>
                    <p class="item-intro text-muted">{{ $recomendacione->categoria }}</p>
                    <img class="img-fluid" src="data:image/jpeg;base64,{{ base64_encode($recomendacione->imagen) }}" alt="{{ $recomendacione->nombre }}" />
                    <p>{{ $recomendacione->descripcion }}</p>

                    <button class="btn btn-success btn-like" data-playa-id="{{ $recomendacione->id }}">
                        <i class="fas fa-thumbs-up me-1"></i> Me gusta
                    </button>

                </div>
            </div>
        </div>
    </div>
    @endforeach



        <!-- Portfolio Grid-->
        
        <!-- About-->
        @include('body.about')

        <!-- Team-->
       <!-- @include('body.team') -->

        <!-- Footer-->
        @include('body.footer')
    
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="{{ asset('assets/toastr.min.js') }}"></script>
        <script>
    $(document).ready(function(){
        $('#btn-guardar-preferencias').click(function(){
            // Obtener los datos del formulario
            var formData = $('#form-preferencias').serialize();

            // Enviar la solicitud Ajax
            $.ajax({
                type: 'POST',
                url: '{{ route("guardar.preferencias") }}',
                data: formData,
                success: function(response){
                    // Manejar la respuesta del servidor
                    if(response.success){
                        toastr.success(response.message, 'Éxito'); // Puedes mostrar un mensaje de éxito o realizar otras acciones
                    } else {
                        toastr.error('Error al guardar preferencia', 'Error');
                    }
                },
                error: function(error){
                    console.log(error);
                    toastr.error('Error al procesar la solicitud', 'Error');
                }
            });
        });
    });
</script>


        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
