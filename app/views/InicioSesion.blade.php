<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sistema de Gestión Médica, Hospital Materno Infantil de El Valle</title>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/login.css')}} ">
    <link rel="icon" href="{{ asset('img/nino_jesus_icono.jpg')}}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Inicio de Sesión<br>
            Sistema de Gestión Médica<br> Hospital Materno Infantil de El Valle
            </h1>
            <div class="account-wall">
                <img class="profile-img" src="{{ asset('img/logo_grande_redondo_icono_brand.png')}}"alt="">
                <form class="form-signin">
                <input type="text" class="form-control" placeholder="Su usuario" required autofocus>
                <input type="password" class="form-control" placeholder="Su contraseña" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesión</button>
{{--                 <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label> --}}
                {{-- <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span> --}}
                </form>
            </div>
            {{-- <a href="#" class="text-center new-account">Create an account </a> --}}
        </div>
    </div>
</div>	
</body>
</html>

