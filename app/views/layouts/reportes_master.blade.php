<!DOCTYPE html>
<html lang="en">
  @include('includes.head_reporte')
<body class="body_reporte">  
  <!--Contenido del modulo -->
    <!-- <div class="container-fluid" style="margin:0px auto;"> -->
        <!-- <div class="content col-xs-12" id="content" > -->
          @yield('cuerpo_reporte')
        <!-- </div> -->
    <!-- </div> -->
    <!-- /.container -->
    <footer class="row" align="center">    
    	@include('includes.footer_libjs')    
    </footer>
    	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->    
  </body>
</html>
