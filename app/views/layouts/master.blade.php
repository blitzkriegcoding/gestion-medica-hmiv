<!DOCTYPE html>
<html lang="en">
  @include('includes.head')
<body class="fuelux">
  @include('includes.header')
  <!--Contenido del modulo -->
    <div class="container-fluid">
        <div class="content col-md-12" id="content" style="padding-top:100px;">
          @yield('formularios')
        </div>
    </div>
    <!-- /.container -->
    <footer class="row" align="center">
        @include('includes.footer')
    </footer>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="{{ asset('assets/js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    
    {{--Select2 --}}
    <script src="{{ asset('assets/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>    
    <script src="{{ asset('assets/select2/dist/js/i18n/es.js')}}" type="text/javascript"></script>    
    {{--Fin Select2 --}}

    {{--Libreria formValidation.io para validar el wizard --}}
    <script src="{{ asset('assets/formvalidation/dist/js/formValidation.0.6.3.min.js')}}" type="text/javascript"></script>    
    <script src="{{ asset('assets/formvalidation/dist/js/bootstrap.0.6.3.min.js')}}" type="text/javascript"></script>    
    {{--Fin Libreria formValidation.io para validar el wizard --}}
    
    {{--Libreria de FuelUX para el wizard--}}
    <script src="{{ asset('assets/fuelux/dist/js/fuelux.min.js') }}" type="text/javascript"></script>    
    {{--Fin Libreria de FuelUX para el wizard--}}


    {{-- Bootstrap Datepicker para las fechas de nacimiento e ingreso, etc--}}
    <script src="{{ asset('assets/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/bootstrap-datepicker-master/js/locales/bootstrap-datepicker.es.js')}}" type="text/javascript"></script>    
    {{--Fin Bootstrap Datepicker para las fechas de nacimiento e ingreso, etc--}}

    {{--COLOCAR LA SIGUIENTE LIBRERIA SIEMPRE DE ULTIMA --}}
    <script src="{{ asset('assets/js/controles_adicionales.js')}}" type="text/javascript"></script>
    {{--FIN BLOQUE --}}

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->    
  </body>
</html>

