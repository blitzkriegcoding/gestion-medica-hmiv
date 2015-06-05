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
    
    @include('includes.footer_libjs')

    @yield('controles_adicionales')

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->    
  </body>
</html>

