<!-- Modelo de la pagina de sesiones -->
<!DOCTYPE html>
<html>
<head>
    <!-- Esta es la plantilla para el manejo de sesion en laravel -->
    <!--Import Awesome Icon Font-->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!--Import bootstrap.css-->
    <script type="text/javascript" src="{{ asset('js/var.js') }}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/menus.css') }}"  media="screen,projection"/>
    <!-- Definiendo el titulo de la pagina -->
    <title>CrowdInvestment - @yield('titulo')</title>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        while(true){
            $.ajax({
                type: 'POST',
                url: '/contar',
                data: {_token:$('input[name=_token]').val(), _method:'POST'},
                success: function(data) {
                    hidden.fadeOut();
                    // newModal('Acción satisfactoria',data.mensaje, false);
                },
                error: function(){
                    newModal('Error','La accion no pudo llevarse a cabo', false);
                }
            }).delay();
        }
    </script>
</head>
<body>
    <!-- En esta parte va el menu con la directiva includee para que quede en el lugar -->
    @include('menus.principal')

    <!-- Aqui en esta seccion va estar el contenido de la pagina -->
    @yield('contenedor_principal')

    <!-- En esta parte va el pie de pagina con la directiva include para que quede en el lugar -->
    @include('footers.principal')

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>
</html>
