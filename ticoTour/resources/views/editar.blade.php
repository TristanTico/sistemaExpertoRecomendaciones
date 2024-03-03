<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{asset('assets/home.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/toastr.min.css') }}">
</head>
<body>
<section class="page-section">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Editar Preferencias</h2>
            <h3 class="section-subheading">Por favor elige la categoría que prefieras</h3>
        </div>

        <form id="form-preferencias">
            @csrf
            <div class="form-group">
                <label for="categoria">Selecciona una categoría</label>
                <select name="categoria_seleccionada" id="categoria" class="form-control">

                @foreach($categorias as $categoria)
    <option value="{{ $categoria->nombre }}" 
        @if($preferencia && $preferencia->{strtolower($categoria->nombre)} == 1) 
            selected 
        @endif>
        {{ $categoria->nombre }}
    </option>
@endforeach
                    
                </select>
            </div>
            
            <button type="button" id="btn-guardar-preferencias" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('assets/toastr.min.js') }}"></script>
<script>
   $(document).ready(function () {
    $('#btn-guardar-preferencias').click(function () {
        $.ajax({
            url: '{{ route("preferencias.actualizar") }}',
            type: 'POST',
            data: $('#form-preferencias').serialize(),
            success: function (response) {
                toastr.success(response.message);
            },
            error: function (xhr) {
                toastr.error(xhr.responseJSON.message);  // Cambiado de 'error' a 'message'
            }
        });
    });
});
</script>
</body>
</html>