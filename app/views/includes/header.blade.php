<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
                <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logo_grande_redondo_icono_brand_2.jpg')}}" class="img-circle" style="width:75%"  alt="logo" >
      </a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pacientes <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ asset('pacientes_pediatricos/creacion_pacientes_pediatricos') }}">Nuevo Paciente</a></li>
            <li><a href="{{ asset('busquedas/busqueda_nueva') }}">Buscar Paciente</a></li>
            <li><a href="#">Modificar Paciente</a></li>
            <li><a href="#">Baja de Paciente</a></li>            
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Medicos <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{{ asset('medicos/creacion_medicos') }}">Nuevo Médico</a></li>
              <li><a href="#">Buscar Médico</a></li>              
              <li><a href="#">Baja de Médico</a></li>            
            </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Historias <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{asset('busquedas/busqueda_historia_medica')}} ">Buscar Historia</a></li>
            <!--
            <li><a href="#">Cerrar Historia</a></li>             
            -->
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Estadísticas <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="estadisticas/principal">Pacientes</a></li>
            <!-- <li><a href="#">Médicos</a></li> -->
            <!-- <li><a href="#">Patologías</a></li> -->
          </ul>
        </li>        
      </ul>
      <ul class="nav navbar-nav navbar-right navbar-collapse collapse">        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name." ".Auth::user()->last_name }} <span class="glyphicon glyphicon-user"></span><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">            
            <li><a href="#">Acerca del SGM</a></li>            
            <li class="divider"></li>
            <li>{{ HTML::linkRoute('usuarios.cerrar_sesion','Cerrar sesión') }}</li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</header>