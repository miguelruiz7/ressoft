<!DOCTYPE html>
<html class="no-js" lang=""><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIIN | Universidad Tecnológica del Valle del Mezquital</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

{{--     <link rel="apple-touch-icon" href="https://siin3.utvm.edu.mx/siin3/images/icono.jpg">
    <link rel="shortcut icon" href="https://siin3.utvm.edu.mx/siin3/images/icono.jpg">
 --}}

    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/normalize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pe-icon-7-stroke.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cs-skin-elastic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">




<script>
  function muestraPagina(pagina,otro,idnivel){
	  otro='';
	  document.getElementById('divFrame').innerHTML=''+' '+'<iframe width="100%" height="800px" src="'+pagina+'" frameborder="0" allowfullscreen></iframe>';

      document.getElementsByClassName("misubNivel").className='sub-menu children dropdown-menu';

      //document.getElementById('sub'+idnivel).className = 'sub-menu children dropdown-menu show'
      setTimeout("visible("+idnivel+")", 100);
	}
    function visible(idnivel){
        objeto='sub'+idnivel;
        $("#"+objeto).addClass("sub-menu children dropdown-menu show");
        objeto1='sub_'+idnivel;
        objeto2='subn'+idnivel;
        $("#"+objeto1).addClass("menu-item-has-children dropdown show");
        $("#"+objeto2).attr("aria-expanded",false);
        //#20403f


    }
</script>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">




					<li class="menu-title">Control Escolar</li><li class="menu-item-has-children dropdown" id="sub_16">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="subn16"> <i class="menu-icon fa fa-print"></i>Reportes</a>
							<ul class="sub-menu children dropdown-menu misubNivel" id="sub16"><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlEscolar/reportes/aspirantes/aspirantes_reportes.php','menu 1 menun1 6 menun2 1','16');$('.letras').css('color','#FFF');this.style.color='#000';">Aspirantes</a></li></ul></li><li class="menu-item-has-children dropdown" id="sub_18">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="subn18"> <i class="menu-icon fa fa-cogs"></i>Utilerías</a>
							<ul class="sub-menu children dropdown-menu misubNivel" id="sub18"><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlEscolar/otras/directorio_empresarial.php','menu 1 menun1 8 menun2 7','18');$('.letras').css('color','#FFF');this.style.color='#000';">Directorio Empresarial</a></li></ul></li><li class="menu-title">Administración y Finanzas</li><li class="menu-item-has-children dropdown" id="sub_24">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="subn24"> <i class="menu-icon fa fa-sitemap"></i>Personal</a>
							<ul class="sub-menu children dropdown-menu misubNivel" id="sub24"><li><a href="#" class="letras" onclick="muestraPagina('/siin3/personal/empleados/credencial.php','menu 2 menun1 4 menun2 29','24');$('.letras').css('color','#FFF');this.style.color='#000';">Credencial</a></li></ul></li><li class="menu-title">Servicios Estudiantiles</li><li class="menu-title">Coordinación de Sistemas</li><li class="menu-item-has-children dropdown" id="sub_41">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="subn41"> <i class="menu-icon fa fa-laptop"></i>Mantenimiento a Equipos</a>
							<ul class="sub-menu children dropdown-menu misubNivel" id="sub41"><li><a href="#" class="letras" onclick="muestraPagina('/siin3/mantenimientoEquipo/solicitud/peticiones_mtto_usuario.php','menu 4 menun1 1 menun2 1','41');$('.letras').css('color','#FFF');this.style.color='#000';">Correctivos Pendientes</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/mantenimientoEquipo/solicitud/solicitud_apoyo.php','menu 4 menun1 1 menun2 4','41');$('.letras').css('color','#FFF');this.style.color='#000';">Solicitud de servicios</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/mantenimientoEquipo/preventivos/preventivos.php','menu 4 menun1 1 menun2 6','41');$('.letras').css('color','#FFF');this.style.color='#000';">Preventivo</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/mantenimientoEquipo/preventivos/eliminarPreventivo.php','menu 4 menun1 1 menun2 10','41');$('.letras').css('color','#FFF');this.style.color='#000';">Eliminar Preventivo</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/mantenimientoEquipo/equiposComputo/equipos.php','menu 4 menun1 1 menun2 7','41');$('.letras').css('color','#FFF');this.style.color='#000';">Alta de equipos</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/mantenimientoEquipo/equiposComputo/reasignacionLaboratorios.php','menu 4 menun1 1 menun2 8','41');$('.letras').css('color','#FFF');this.style.color='#000';">Asignación/Laboratorios</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/mantenimientoEquipo/reportes/reportes_mtto.php','menu 4 menun1 1 menun2 9','41');$('.letras').css('color','#FFF');this.style.color='#000';">Reportes</a></li></ul></li><li class="menu-item-has-children dropdown" id="sub_42">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="subn42"> <i class="menu-icon fa fa-desktop"></i>Control de Laboratorios</a>
							<ul class="sub-menu children dropdown-menu misubNivel" id="sub42"><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/captura/reservacionMasivaAreas.php','menu 4 menun1 2 menun2 18','42');$('.letras').css('color','#FFF');this.style.color='#000';">Reservación Masiva</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/captura/reservaciones.php','menu 4 menun1 2 menun2 1','42');$('.letras').css('color','#FFF');this.style.color='#000';">Reservacion Alumnos</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/captura/reservacion_laboratorio.php','menu 4 menun1 2 menun2 2','42');$('.letras').css('color','#FFF');this.style.color='#000';">Reservacion Areas</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/solicitudInternet/solicitudInternet.php','menu 4 menun1 2 menun2 12','42');$('.letras').css('color','#FFF');this.style.color='#000';">Solicitudes internet</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/registro/horario.php','menu 4 menun1 2 menun2 3','42');$('.letras').css('color','#FFF');this.style.color='#000';">Registro de Incidencias</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/horarios/scl_horarios.php','menu 4 menun1 2 menun2 4','42');$('.letras').css('color','#FFF');this.style.color='#000';">Captura Horarios</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/catalogos/scl_softwareAsignar.php','menu 4 menun1 2 menun2 6','42');$('.letras').css('color','#FFF');this.style.color='#000';">Asignación de software</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlEscolar/horariosIntranet/horariosLaboratoriosGenerales.php','menu 4 menun1 2 menun2 8','42');$('.letras').css('color','#FFF');this.style.color='#000';">Horarios Intranet Labs.</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/captura/horarios.php','menu 4 menun1 2 menun2 23','42');$('.letras').css('color','#FFF');this.style.color='#000';">Seguimiento Laboratorios</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/captura/impresiones.php','menu 4 menun1 2 menun2 14','42');$('.letras').css('color','#FFF');this.style.color='#000';">Impresiones</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/bitacoraAtencionUsuarios.php','menu 4 menun1 2 menun2 15','42');$('.letras').css('color','#FFF');this.style.color='#000';">Bitácora de Atención</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/reportes/reportes.php','menu 4 menun1 2 menun2 7','42');$('.letras').css('color','#FFF');this.style.color='#000';">Reportes</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlLaboratorios/reservacionEquipos/reservacionMenu.php','menu 4 menun1 2 menun2 22','42');$('.letras').css('color','#FFF');this.style.color='#000';">Reservaciones de Equipos</a></li></ul></li><li class="menu-item-has-children dropdown" id="sub_43">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="subn43"> <i class="menu-icon fa fa-print"></i>Reportes a la CSyT</a>
							<ul class="sub-menu children dropdown-menu misubNivel" id="sub43"><li><a href="#" class="letras" onclick="muestraPagina('/siin3/ordenesTrabajo/informeActividades/actividadesProgramadasInicio.php','menu 4 menun1 3 menun2 9','43');$('.letras').css('color','#FFF');this.style.color='#000';">Actividades Programadas</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/ordenesTrabajo/informeActividades/informeActividadesIndividual.php','menu 4 menun1 3 menun2 1','43');$('.letras').css('color','#FFF');this.style.color='#000';">Actividades Mensuales</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/ordenesTrabajo/vitacoras/vitacora_registro.php','menu 4 menun1 3 menun2 4','43');$('.letras').css('color','#FFF');this.style.color='#000';">Incidencias</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/ordenesTrabajo/recorrido_laboratorios/registro_laboratorios.php','menu 4 menun1 3 menun2 6','43');$('.letras').css('color','#FFF');this.style.color='#000';">Recorrido laboratorios</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/ordenesTrabajo/modulos/registro_modulos.php','menu 4 menun1 3 menun2 7','43');$('.letras').css('color','#FFF');this.style.color='#000';">Registro Modulos</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/ordenesTrabajo/ordenesTrabajo/ordenesTrabajo.php','menu 4 menun1 3 menun2 8','43');$('.letras').css('color','#FFF');this.style.color='#000';">Ordenes de Trabajo</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/ordenesTrabajo/scrum/scrumBoard.php','menu 4 menun1 3 menun2 10','43');$('.letras').css('color','#FFF');this.style.color='#000';">Scrum Board</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/ordenesTrabajo/scrum/scrumDaily.php','menu 4 menun1 3 menun2 11','43');$('.letras').css('color','#FFF');this.style.color='#000';">Scrum Daily</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/personal/permisos/pagos.php','menu 4 menun1 3 menun2 12','43');$('.letras').css('color','#FFF');this.style.color='#000';">Tiempo Extra</a></li><li><a href="#" class="letras" onclick="muestraPagina('/siin3/personal/permisos/permisos.php','menu 4 menun1 3 menun2 13','43');$('.letras').css('color','#FFF');this.style.color='#000';">Permisos</a></li></ul></li><li class="menu-item-has-children dropdown" id="sub_44">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="subn44"> <i class="menu-icon fa fa-code"></i>Desarrollo de Sistemas</a>
							<ul class="sub-menu children dropdown-menu misubNivel" id="sub44"><li><a href="#" class="letras" onclick="muestraPagina('/siin3/controlEscolar/modulo_consulta/usuarios.php','menu 4 menun1 4 menun2 4','44');$('.letras').css('color','#FFF');this.style.color='#000';">Cambio contraseñas</a></li></ul></li><li class="menu-title">Vinculación</li><li class="menu-title">Secretaria Académica</li><li class="menu-item-has-children dropdown" id="sub_67">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="subn67"> <i class="menu-icon fa fa-gift"></i>Capacitación Integral</a>
							<ul class="sub-menu children dropdown-menu misubNivel" id="sub67"><li><a href="#" class="letras" onclick="muestraPagina('/siin3/pinaae/cursos/asistenciaEstudiantes.php','menu 6 menun1 7 menun2 7','67');$('.letras').css('color','#FFF');this.style.color='#000';">Asistencia</a></li></ul></li></ul>



            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="https://siin3.utvm.edu.mx/siin3/"><img src="siin3/logoPrincipal.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="https://siin3.utvm.edu.mx/siin3/"><img src="siin3/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">


                        <div class="dropdown for-notification">

                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>


                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<font style="font-size:12px; color:#fff;">ING. LUIS ZENIL CANDELARIA </font> &nbsp; <img class="user-avatar rounded-circle" src="siin3/958.jpg">
                        </a>

                        <div class="user-menu dropdown-menu">
                           <a class="nav-link" href="https://siin3.utvm.edu.mx/siin3/salir.php" style="color:#000" onmouseover="this.style.color='#980000';" onmouseout="this.style.color='#000';"><i class="fa fa-power-off"></i>Salir</a>


                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
			<div id="divFrame">
			<iframe style="width: 100%;height: 900px;border-color: #FFF;border-width: 0px" src="siin3/inicio.htm"></iframe></div>
            <!-- .animated -->
        </div>
        <!-- /.content -->

        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Derechos Reservados © 2024 <a href="http://www.utvm.edu.mx/" target="_blank">Universidad Tecnológica del Valle del Mezquital</a>
                    </div>
                    <div class="col-sm-6 text-right">
                        Coordinación de Sistemas y Telecomunicaciones
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->



    <script src="{{ asset('js/jquery-1.9.1.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.matchHeight.min.js')}}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

{{--     <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script> --}}
{{--    <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script> --}}




</body></html>
