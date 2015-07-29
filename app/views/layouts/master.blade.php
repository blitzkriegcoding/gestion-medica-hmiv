<!DOCTYPE html>
<html lang="en">
  @include('includes.head')
<body class="fuelux">
  @include('includes.header')
  <!--Contenido del modulo -->
    <div class="container-fluid" style="height:35em; margin:0px auto;">
        <div class="content col-xs-12" id="content" style="padding-top:30px;">
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

