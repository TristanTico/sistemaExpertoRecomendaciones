<section class="page-section" id="services" style="
    @if($preferenciaElegida)
        background: linear-gradient(to bottom, 
            @if($preferenciaElegida->playa)
                #00ffff,
            @elseif($preferenciaElegida->montaña)
                #99cc00,
            @elseif($preferenciaElegida->ciudad)
                #6666ff,
            @endif
            #ffffff); /* Color blanco para el fondo */
    @elseif($contador && !$preferenciaElegida)
        background: linear-gradient(to bottom, 
            @if($contador->playaCont > $contador->montañaCont && $contador->playaCont > $contador->ciudadCont)
                #00ffff,
            @elseif($contador->montañaCont > $contador->ciudadCont)
                #99cc00,
            @else
                #6666ff,
            @endif
            #ffffff); /* Color blanco para el fondo */
    @endif
">
    <!-- Contenido de tu sección -->
</section>

            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Destinos</h2>
                    <h3 class="section-subheading ">Embárcate en un viaje inolvidable mientras exploras nuestros destinos cuidadosamente seleccionados. Desde playas paradisíacas hasta majestuosas montañas y vibrantes ciudades, tenemos el destino perfecto para cada tipo de viajero..</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-building fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3"><a class="text-decoration-none" href="{{ route('ciudad') }}">Ciudades</a></h4>
                        <p class="">Explora los tesoros urbanos que nuestras ciudades tienen para ofrecer. Descubre la arquitectura icónica, los vibrantes barrios y la diversidad cultural que hacen de cada ciudad un destino fascinante.</p>
                    </div>

                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-success"></i>
                            <i class="fas fa-volcano fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3"><a class="text-decoration-none" href="{{ route('montaña') }}">Montañas</a></h4>
                        <p class="">Descubre la serenidad en las alturas de nuestras montañas, donde la quietud y la majestuosidad se encuentran. Cada cima es una invitación a la contemplación y la conexión con el entorno natural.</p>
                    </div>

                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-info"></i>
                            <i class="fas fa-umbrella fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3"><a class="text-decoration-none" href="{{ route('playa') }}">Playas</a></h4>
                        <p class="">Descubre playas de ensueño donde el tiempo se detiene y la vida se disfruta a orillas del océano. Palmas que se mecen con la brisa y arenas suaves crean el escenario perfecto para momentos inolvidables.</p>
                    </div>


                </div>
            </div>
        </section>
