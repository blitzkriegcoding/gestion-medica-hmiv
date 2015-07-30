<!DOCTYPE html>
<html lang="en">
  @include('includes.head')
<body >  
  <!--Contenido del modulo -->
    <div class="container-fluid" style="height:35em; margin:0px auto;">
        <div class="content col-xs-12" id="content" style="padding-top:0px;">
          @yield('cuerpo_reporte')
        </div>
    </div>
    <!-- /.container -->
    <footer class="row" align="center">        
    </footer>
    	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->    
  </body>
</html>
