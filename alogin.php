<?php

require 'includes/funcionesUsuarios.php';
require 'includes/funcionesReferencias.php';
require 'includes/funciones.php';
require 'includes/validadores.php';

session_start();

$serviciosUsuario = new ServiciosUsuarios();
$serviciosReferencias = new ServiciosReferencias();
$serviciosFunciones 	= new Servicios();
$serviciosValidador = new serviciosValidador();

if (isset($_SESSION['usua_sahilices'])) {
   if (isset($_GET['token'])) {
      $resAutologin = $serviciosReferencias->traerAutologinPorToken($_GET['token']);
      if (mysql_num_rows($resAutologin) > 0) {
         header('Location: dashboard/'.mysql_result($resAutologin,0,'url'));
      } else {
         header('Location: dashboard/index.php');
      }
   } else {
      header('Location: dashboard/index.php');
   }

} else {

   if (isset($_GET['token'])) {
      $resAutologin = $serviciosReferencias->traerAutologinPorToken($_GET['token']);

      if (mysql_num_rows($resAutologin) > 0) {
         $resUsuario = $serviciosUsuario->traerUsuarioIdAutoLogin(mysql_result($resAutologin,0,'refusuarios'));
         if (mysql_num_rows($resAutologin) > 0) {

            if (mysql_result($resUsuario,0,'refroles') == 16) {
               $resCliente = $serviciosUsuario->traerClientesPorUsuario(mysql_result($resAutologin,0,'refusuarios'));

               $_SESSION['idcliente_sahilices'] = mysql_result($resCliente,0,0);
            }
   			$_SESSION['usua_sahilices'] = mysql_result($resUsuario,0,'email');
   			$_SESSION['nombre_sahilices'] = mysql_result($resUsuario,0,'nombrecompleto');
   			$_SESSION['usuaid_sahilices'] = mysql_result($resUsuario,0,0);
   			$_SESSION['email_sahilices'] = mysql_result($resUsuario,0,'email');
   			$_SESSION['idroll_sahilices'] = mysql_result($resUsuario,0,'refroles');
   			$_SESSION['refroll_sahilices'] = mysql_result($resUsuario,0,'descripcion');

            //die(var_dump(mysql_result($resAutologin,0,'url')));
            header('Location: dashboard/'.mysql_result($resAutologin,0,'url'));
         } else {
            header('Location: index.html');
         }
      } else {
         header('Location: index.html');
      }

   } else {
      header('Location: index.html');
   }


}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Acceder | ASESORES CREA</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
           <div class="row">
              <div class="col-md-12" align="center">
                 <img src="imagenes/logo.png" alt="ASESORES CREA" width="80%">
              </div>
           </div>

        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Login</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line emailInput">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required autofocus>

                        </div>

                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line passInput">
                            <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>

                        </div>

                    </div>
                    <div class="row js-sweetalert">
                        <div class="col-xs-8 p-t-5">

                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-blue waves-effect" data-type="" type="submit" id="login">ENTRAR</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-5">

                        </div>
                        <div class="col-xs-7 align-right">
                            <a href="recuperar.html">He olvidado mi contraseña</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <script src="js/pages/ui/dialogs.js"></script>


    <script type="text/javascript">

        $(document).ready(function(){


            $('body').keyup(function(e) {
                if(e.keyCode == 13) {
                    $("#login").click();
                }
            });


            $("#sign_in").submit(function(e){

                e.preventDefault();
                if ($('#sign_in')[0].checkValidity()) {

                   $.ajax({
                       data:  {email:		$("#email").val(),
                               pass:		$("#pass").val(),
                               accion:		'login'},
                       url:   'ajax/ajax.php',
                       type:  'post',
                       beforeSend: function () {
                               $("#load").html('<img src="imagenes/load13.gif" width="50" height="50" />');
                       },
                       success:  function (response) {

                               if (isNaN(response)) {

                                   swal({
                                       title: "Respuesta",
                                       text: "Usuario o Password Incorrectos",
                                       type: "error",
                                       timer: 2000,
                                       showConfirmButton: false
                                   });

                               } else {
                                   swal({
                                       title: "Respuesta",
                                       text: "Acceso Correcto",
                                       type: "success",
                                       timer: 1500,
                                       showConfirmButton: false
                                   });

                                   url = "dashboard/";
                                   $(location).attr('href',url);
                               }

                       }
                   });
                }


            });

        });/* fin del document ready */

    </script>
</body>

</html>
