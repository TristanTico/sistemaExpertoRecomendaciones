@php
    $id = Auth::user()->id;
    $adminData = App\Models\User::find($id);

    $user = auth()->user();
    $tienePreferencias = \App\Models\Preferencias::where('user_id', $user->id)->exists();
@endphp

<style>
    /* Agrega estas reglas CSS para cambiar el color de las letras a negro */
    .navbar-nav .nav-link {
        color: black !important;
    }

    /* Estilos para ocultar el navbar */
    .hide-nav {
        transform: translateY(-100%);
        transition: transform 0.5s ease;
    }
</style>

<script>
    let lastScrollTop = 0;
    window.addEventListener("scroll", () => {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        let navbar = document.getElementById("mainNav");
        if (currentScroll > lastScrollTop) {
            // Scroll hacia abajo
            navbar.classList.add("hide-nav");
        } else {
            // Scroll hacia arriba
            navbar.classList.remove("hide-nav");
        }
        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Para dispositivos móviles
    });
</script>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">

    <div class="container">
        <img src="{{asset('assets/logo.png')}}" style="width: 80px;" alt="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('Home')}}">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>

                @if($tienePreferencias)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('editar')}}">
                        <i class="fas fa-globe"></i> Preferencias
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="#about">
                        <i class="fas fa-user" style="color: blue;"></i> <span style="color: blue;">Bienvenido, {{ $adminData->name }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">
                        <i class="fas fa-lock"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>