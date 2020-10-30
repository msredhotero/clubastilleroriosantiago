<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');
include ('../includes/funcionesNotificaciones.php');
include ('../includes/funcionesMensajes.php');
include ('../includes/validadores.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();
$serviciosNotificaciones	= new ServiciosNotificaciones();
$serviciosMensajes	= new ServiciosMensajes();
$serviciosValidador        = new serviciosValidador();


$accion = $_POST['accion'];

$resV['error'] = '';
$resV['mensaje'] = '';

date_default_timezone_set('America/Mexico_City');



switch ($accion) {
   case 'llenarCombosGral':
      llenarCombosGral($serviciosReferencias, $serviciosUsuarios,$serviciosFunciones,$serviciosPostal);
   break;

   case 'login':
      enviarMail($serviciosUsuarios);
      break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosReferencias);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
		break;
   case 'registrarme':
      registrarme($serviciosUsuarios, $serviciosReferencias, $serviciosValidador);
   break;
   case 'insertarUsuarios':
        insertarUsuarios($serviciosReferencias);
   break;
   case 'recuperar':
      recuperar($serviciosUsuarios);
   break;

   case 'eliminarUsuarios':
      eliminarUsuarios($serviciosUsuarios, $serviciosReferencias);
   break;

   case 'activarUsuario':
      activarUsuario($serviciosUsuarios, $serviciosReferencias);
   break;
   case 'activarUsuarioPostulante':
      activarUsuarioPostulante($serviciosUsuarios, $serviciosReferencias);
   break;
   case 'activarUsuarioCliente':
      activarUsuarioCliente($serviciosUsuarios, $serviciosReferencias);
   break;


   case 'frmAjaxModificar':
      frmAjaxModificar($serviciosFunciones, $serviciosReferencias, $serviciosUsuarios);
   break;
   case 'frmAjaxVer':
      frmAjaxVer($serviciosFunciones, $serviciosReferencias, $serviciosUsuarios);
   break;



   case 'traerUsuarios':
      traerUsuarios($serviciosReferencias);
   break;
   case 'traerUsuariosPorId':
      traerUsuariosPorId($serviciosReferencias);
   break;


   /****   	notificaciones * *************/
   case 'marcarNotificacion':
   	marcarNotificacion($serviciosNotificaciones);
	break;
   case 'generarNotificacion':
   	generarNotificacion($serviciosNotificaciones);
	break;
   /****			fin 				******/


   case 'generaNotificacion':
      generaNotificacion($serviciosReferencias, $serviciosMensajes, $serviciosNotificaciones,$serviciosUsuarios);
   break;



   case 'modPassword':
      modPassword($serviciosReferencias);
   break;


case 'insertarCitas':
insertarCitas($serviciosReferencias);
break;
case 'modificarCitas':
modificarCitas($serviciosReferencias);
break;
case 'eliminarCitas':
eliminarCitas($serviciosReferencias);
break;
case 'traerCitas':
traerCitas($serviciosReferencias);
break;
case 'traerCitasPorId':
traerCitasPorId($serviciosReferencias);
break;

case 'insertarPacientes':
insertarPacientes($serviciosReferencias);
break;
case 'modificarPacientes':
modificarPacientes($serviciosReferencias);
break;
case 'eliminarPacientes':
eliminarPacientes($serviciosReferencias);
break;
case 'traerPacientes':
traerPacientes($serviciosReferencias);
break;
case 'traerPacientesPorId':
traerPacientesPorId($serviciosReferencias);
break;

case 'insertarAseguradoras':
insertarAseguradoras($serviciosReferencias);
break;
case 'modificarAseguradoras':
modificarAseguradoras($serviciosReferencias);
break;
case 'eliminarAseguradoras':
eliminarAseguradoras($serviciosReferencias);
break;
case 'traerAseguradoras':
traerAseguradoras($serviciosReferencias);
break;
case 'traerAseguradorasPorId':
traerAseguradorasPorId($serviciosReferencias);
break;

case 'insertarEmpleados':
insertarEmpleados($serviciosReferencias);
break;
case 'modificarEmpleados':
modificarEmpleados($serviciosReferencias);
break;
case 'eliminarEmpleados':
eliminarEmpleados($serviciosReferencias);
break;
case 'traerEmpleados':
traerEmpleados($serviciosReferencias);
break;
case 'traerEmpleadosPorId':
traerEmpleadosPorId($serviciosReferencias);
break;

case 'insertarMetodopago':
insertarMetodopago($serviciosReferencias);
break;
case 'modificarMetodopago':
modificarMetodopago($serviciosReferencias);
break;
case 'eliminarMetodopago':
eliminarMetodopago($serviciosReferencias);
break;
case 'traerMetodopago':
traerMetodopago($serviciosReferencias);
break;
case 'traerMetodopagoPorId':
traerMetodopagoPorId($serviciosReferencias);
break;

case 'insertarTiposervicios':
insertarTiposervicios($serviciosReferencias);
break;
case 'modificarTiposervicios':
modificarTiposervicios($serviciosReferencias);
break;
case 'eliminarTiposervicios':
eliminarTiposervicios($serviciosReferencias);
break;
case 'traerTiposervicios':
traerTiposervicios($serviciosReferencias);
break;
case 'traerTiposerviciosPorId':
traerTiposerviciosPorId($serviciosReferencias);
break;


}
/* FinFinFin */


function frmAjaxModificar($serviciosFunciones, $serviciosReferencias, $serviciosUsuarios) {
   $tabla = $_POST['tabla'];
   $id = $_POST['id'];

   $url = '';

   session_start();

   switch ($tabla) {
      case 'tbaseguradoras':
         $resultado = $serviciosReferencias->traerAseguradorasPorId( $id);

         $modificar = "modificarAseguradoras";
         $idTabla = "idaseguradora";

         $lblCambio	 	= array();
         $lblreemplazo	= array();

         $refdescripcion = array();
         $refCampo 	=  array();
      break;
      case 'tbtiposervicios':
         $resultado = $serviciosReferencias->traerTiposerviciosPorId( $id);

         $modificar = "modificarTiposervicios";
         $idTabla = "idtiposervicio";

         $lblCambio	 	= array('tiposervicio');
         $lblreemplazo	= array('Tipo de Servicio');

         $refdescripcion = array();
         $refCampo 	=  array();
      break;
      case 'tbmetodopago':
         $resultado = $serviciosReferencias->traerMetodopagoPorId( $id);

         $modificar = "modificarMetodopago";
         $idTabla = "idmetodopago";

         $lblCambio	 	= array('metodopago');
         $lblreemplazo	= array('Método de Pago');

         $refdescripcion = array();
         $refCampo 	=  array();
      break;
      case 'tbempleados':
         $resultado = $serviciosReferencias->traerEmpleadosPorId( $id);

         $modificar = "modificarEmpleados";
         $idTabla = "idempleado";

         $lblCambio	 	= array();
         $lblreemplazo	= array();

         $refdescripcion = array();
         $refCampo 	=  array();
      break;
      case 'dbpacientes':
         $resultado = $serviciosReferencias->traerPacientesPorId( $id);

         $modificar = "modificarPacientes";
         $idTabla = "idpaciente";

         $lblCambio	 	= array();
         $lblreemplazo	= array();

         $refdescripcion = array();
         $refCampo 	=  array();
      break;
      case 'dbcitas':
         $resultado = $serviciosReferencias->traerCitasPorId( $id);

         $modificar = "modificarCitas";
         $idTabla = "idcita";

         $lblCambio	 	= array('refpacientes','refaseguradoras','refmetodopago','reftiposervicios','refempleados','iva','irpf');
         $lblreemplazo	= array('Paciente','Aseguradoras','Método de Pago','Tipo de Servicios','Empleados','IVA','IRPF');

         $resVar1 = $serviciosReferencias->traerPacientesInfo();
         $cadRef1 = $serviciosFunciones->devolverSelectBoxActivo($resVar1,array(9),' ',mysql_result($resultado,0,'refpacientes'));

         $resVar2 = $serviciosReferencias->traerAseguradoras();
         $cadRef2 = '<option value="">-- Seleccionar --</option>';
         $cadRef2 .= $serviciosFunciones->devolverSelectBoxActivo($resVar2,array(1),' ',mysql_result($resultado,0,'refaseguradoras'));

         $resVar3 = $serviciosReferencias->traerMetodopago();
         $cadRef3 = $serviciosFunciones->devolverSelectBoxActivo($resVar3,array(1),' ',mysql_result($resultado,0,'refmetodopago'));

         $resVar4 = $serviciosReferencias->traerTiposervicios();
         $cadRef4 = $serviciosFunciones->devolverSelectBoxActivo($resVar4,array(1),' ',mysql_result($resultado,0,'reftiposervicios'));

         $resVar5 = $serviciosReferencias->traerEmpleados();
         $cadRef5 = '<option value="">-- Seleccionar --</option>';
         $cadRef5 .= $serviciosFunciones->devolverSelectBoxActivo($resVar5,array(1,2),' ',mysql_result($resultado,0,'refempleados'));

         $refdescripcion = array(0=>$cadRef1,1=>$cadRef2,2=>$cadRef3,3=>$cadRef4,4=>$cadRef5);
         $refCampo 	=  array('refpacientes','refaseguradoras','refmetodopago','reftiposervicios','refempleados');
      break;


      default:
         // code...
         break;
   }

   $formulario = $serviciosFunciones->camposTablaModificar($id, $idTabla,$modificar,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

   if ($url != '') {
      echo $url;
   } else {
      switch ($tabla) {
         case 'dbentrevistas':
         echo str_replace('codigopostal','codigopostal2',$formulario);
         break;
         case 'dbentrevistaoportunidades':
         echo str_replace('codigopostal','codigopostal2',$formulario);
         break;
         case 'tbentrevistasucursales':
         echo str_replace('refpostal','refpostal2',$formulario);
         break;
         case 'dbasesores':
         echo str_replace('codigopostal','codigopostal2',$formulario);
         break;
         default:
            echo $formulario;
         break;
      }

   }

}


function insertarCitas($serviciosReferencias) {
   $refpacientes = $_POST['refpacientes'];
   $refempleados = ($_POST['refempleados'] == '' ? 0 : $_POST['refempleados']);
   $reftiposervicios = $_POST['reftiposervicios'];
   $refaseguradoras = ($_POST['refaseguradoras'] == '' ? 0 : $_POST['refaseguradoras']);
   $refmetodopago = $_POST['refmetodopago'];
   $fecha = $_POST['fecha'];
   $hora = $_POST['hora'];
   $precio = ($_POST['precio'] == '' ? 0 : $_POST['precio']);
   $iva = ($_POST['iva'] == '' ? 0 : $_POST['iva']);
   $irpf = ($_POST['irpf'] == '' ? 0 : $_POST['irpf']);
   $observaciones = $_POST['observaciones'];

   $res = $serviciosReferencias->insertarCitas($refpacientes,$refempleados,$reftiposervicios,$refaseguradoras,$refmetodopago,$fecha,$hora,$precio,$iva,$irpf,$observaciones);

   if ((integer)$res > 0) {
      echo '';
   } else {
      echo 'Hubo un error al insertar datos';
   }
}

function modificarCitas($serviciosReferencias) {
   $id = $_POST['id'];
   $refpacientes = $_POST['refpacientes'];
   $refempleados = ($_POST['refempleados'] == '' ? 0 : $_POST['refempleados']);
   $reftiposervicios = $_POST['reftiposervicios'];
   $refaseguradoras = ($_POST['refaseguradoras'] == '' ? 0 : $_POST['refaseguradoras']);
   $refmetodopago = $_POST['refmetodopago'];
   $fecha = $_POST['fecha'];
   $hora = $_POST['hora'];
   $precio = ($_POST['precio'] == '' ? 0 : $_POST['precio']);
   $iva = ($_POST['iva'] == '' ? 0 : $_POST['iva']);
   $irpf = ($_POST['irpf'] == '' ? 0 : $_POST['irpf']);
   $observaciones = $_POST['observaciones'];

   $res = $serviciosReferencias->modificarCitas($id,$refpacientes,$refempleados,$reftiposervicios,$refaseguradoras,$refmetodopago,$fecha,$hora,$precio,$iva,$irpf,$observaciones);

   if ($res == true) {
      echo '';
   } else {
      echo 'Hubo un error al modificar datos';
   }
}
function eliminarCitas($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarCitas($id);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al eliminar datos';
}
}
function traerCitas($serviciosReferencias) {
$res = $serviciosReferencias->traerCitas();
$ar = array();
while ($row = mysql_fetch_array($res)) {
array_push($ar, $row);
}
$resV['datos'] = $ar;
header('Content-type: application/json');
echo json_encode($resV);
}


function insertarPacientes($serviciosReferencias) {
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$tutor = $_POST['tutor'];
$direccion = $_POST['direccion'];
$observaciones = $_POST['observaciones'];
$res = $serviciosReferencias->insertarPacientes($nombre,$apellido,$telefono,$email,$dni,$tutor,$direccion,$observaciones);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Hubo un error al insertar datos';
}
}
function modificarPacientes($serviciosReferencias) {
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$tutor = $_POST['tutor'];
$direccion = $_POST['direccion'];
$observaciones = $_POST['observaciones'];
$res = $serviciosReferencias->modificarPacientes($id,$nombre,$apellido,$telefono,$email,$dni,$tutor,$direccion,$observaciones);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al modificar datos';
}
}
function eliminarPacientes($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarPacientes($id);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al eliminar datos';
}
}
function traerPacientes($serviciosReferencias) {
$res = $serviciosReferencias->traerPacientes();
$ar = array();
while ($row = mysql_fetch_array($res)) {
array_push($ar, $row);
}
$resV['datos'] = $ar;
header('Content-type: application/json');
echo json_encode($resV);
}


function insertarAseguradoras($serviciosReferencias) {
$aseguradora = $_POST['aseguradora'];
$res = $serviciosReferencias->insertarAseguradoras($aseguradora);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Hubo un error al insertar datos';
}
}
function modificarAseguradoras($serviciosReferencias) {
$id = $_POST['id'];
$aseguradora = $_POST['aseguradora'];
$res = $serviciosReferencias->modificarAseguradoras($id,$aseguradora);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al modificar datos';
}
}
function eliminarAseguradoras($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarAseguradoras($id);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al eliminar datos';
}
}
function traerAseguradoras($serviciosReferencias) {
$res = $serviciosReferencias->traerAseguradoras();
$ar = array();
while ($row = mysql_fetch_array($res)) {
array_push($ar, $row);
}
$resV['datos'] = $ar;
header('Content-type: application/json');
echo json_encode($resV);
}


function insertarEmpleados($serviciosReferencias) {
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$res = $serviciosReferencias->insertarEmpleados($nombre,$apellido,$dni);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Hubo un error al insertar datos';
}
}
function modificarEmpleados($serviciosReferencias) {
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$res = $serviciosReferencias->modificarEmpleados($id,$nombre,$apellido,$dni);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al modificar datos';
}
}
function eliminarEmpleados($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarEmpleados($id);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al eliminar datos';
}
}
function traerEmpleados($serviciosReferencias) {
$res = $serviciosReferencias->traerEmpleados();
$ar = array();
while ($row = mysql_fetch_array($res)) {
array_push($ar, $row);
}
$resV['datos'] = $ar;
header('Content-type: application/json');
echo json_encode($resV);
}


function insertarMetodopago($serviciosReferencias) {
$metodopago = $_POST['metodopago'];
$res = $serviciosReferencias->insertarMetodopago($metodopago);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Hubo un error al insertar datos';
}
}
function modificarMetodopago($serviciosReferencias) {
$id = $_POST['id'];
$metodopago = $_POST['metodopago'];
$res = $serviciosReferencias->modificarMetodopago($id,$metodopago);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al modificar datos';
}
}
function eliminarMetodopago($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarMetodopago($id);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al eliminar datos';
}
}


function insertarTiposervicios($serviciosReferencias) {
$tiposervicio = $_POST['tiposervicio'];
$res = $serviciosReferencias->insertarTiposervicios($tiposervicio);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Hubo un error al insertar datos';
}
}
function modificarTiposervicios($serviciosReferencias) {
$id = $_POST['id'];
$tiposervicio = $_POST['tiposervicio'];
$res = $serviciosReferencias->modificarTiposervicios($id,$tiposervicio);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al modificar datos';
}
}
function eliminarTiposervicios($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarTiposervicios($id);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al eliminar datos';
}
}

function modPassword($serviciosReferencias) {
   session_start();

   $passa = $_POST['passa'];
   $passn = $_POST['passn'];
   $passnn = $_POST['passnn'];

   $resUsuario = $serviciosReferencias->traerUsuariosPorId($_SESSION['usuaid_sahilices']);

   $error = '';
   if (mysql_result($resUsuario,0,'password') !== $passa) {
      $error = 'La contraseña actual es erronea';
   }

   if ($passn !== $passnn) {
      $error = 'La contraseña nueva difiere de la confirmación de la contraseña';
   }

   if (($passn == '') || ($passnn == '')) {
      $error = 'La contraseña nueva es obligatoria';
   }

   if ($passn === $passa) {
      $error = 'La contraseña nueva no puede ser igual a la actual';
   }

   if(!preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', $passn)) {
      $error = 'La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.';
   }

   if ($error == '') {
      $res = $serviciosReferencias->modPassword($_SESSION['usuaid_sahilices'],$passn);
      if ($res) {
         $resV['error'] = false;

      } else {
         $resV['error'] = true;
         $resV['mensaje'] = 'Se genero un error al modificar los datos, vuelva a intentarlo';
      }
   } else {
      $resV['error'] = true;
      $resV['mensaje'] = $error;
   }




   header('Content-type: application/json');
   echo json_encode($resV);

}


////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
       $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$nombre			   =	$_POST['nombre'];
	$apellido		   =	$_POST['apellido'];
	$fechanacimiento	=	$_POST['fechanacimiento'];
   $telefono	      =	$_POST['telefono'];
	$email			   =	$_POST['email'];
	$sexo			      =	$_POST['sexo'];
   $codigopostal		=	$_POST['codigopostal'];

	   $res = $serviciosUsuarios->registrarSocio($nombre,$apellido,$fechanacimiento,$telefono,$email,$sexo,$codigopostal);
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo $res;
	}
}


function insertarUsuario($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];

	   $res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo $res;
	}
}


function insertarUsuarios($serviciosReferencias) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
   $refsocios = $_POST['refsocios'];

	   $res = $serviciosReferencias->insertarUsuarios($usuario,$password,$refroll,$email,$nombre,1,$refsocios);
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo $res;
	}
}


function modificarUsuario($serviciosReferencias) {
	$id					=	$_POST['id'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
   $refsocios = $_POST['refsocios'];

   if (isset($_POST['activo'])) {
      $activo = 1;
   } else {
      $activo = 0;
   }

	$res = $serviciosReferencias->modificarUsuarios($id,$usuario,$password,$refroll,$email,$nombre,$activo,$refsocios);

   if ($res == true) {
      echo '';
   } else {
      echo 'Hubo un error al modificar datos';
   }
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	//$idempresa  =	$_POST['idempresa'];

	echo $serviciosUsuarios->login($email,$pass);
}

function registrarme($serviciosUsuarios, $serviciosReferencias, $serviciosValidador) {
   $error = '';

   $nombre			   =	trim($_POST['nombre']);
	$apellidopaterno  =  trim($_POST['apellidopaterno']);
   $apellidomaterno  =  trim($_POST['apellidomaterno']);
	$fechanacimiento	=	$_POST['fechanacimiento'];
   $telefono	      =	trim($_POST['telefono']);
	$email            =  trim($_POST['email']);
	$sexo			      =	$_POST['sexo'];
   $codigopostal		=	trim($_POST['codigopostal']);

   $aceptaterminos   = $_POST['terminos'];


   $pass       = $serviciosReferencias->GUID();

   $existeEmail = $serviciosUsuarios->existeUsuario($email);
   //$existeCliente = $serviciosReferencias->existeCliente($cuit);

   if ($existeEmail == 1) {
      $error .= 'El Email ingresado ya existe!
      ';
   }


   if ($aceptaterminos == 0) {
      $error .= 'Debe Aceptar los Terminos y Condiciones
      ';
   }

   if ($error == '') {
      // todo ok
      $refestadocivil = 1;
      $rfc = '0';
      $curp = '0';
      $numerocliente = '0000';
      $nacionalidad = 'Mexico';
      $refpromotores = 0;
      $refrolhogar = 1;
      $reftipoclientes = 1;
      $refentidadnacimiento = 1;
      $fechacrea = date('Y-m-d');
      $fechamodi = date('Y-m-d');
      $usuariocrea = 'Web';
      $usuariomodi = '';


         $res = $serviciosReferencias->insertarClientes($nombre,$apellidopaterno,$apellidomaterno,$email,$sexo,$refestadocivil,$rfc,$curp,$fechanacimiento,$numerocliente,$nacionalidad,$refpromotores,$refrolhogar,$reftipoclientes,$refentidadnacimiento,$fechacrea,$fechamodi,$usuariocrea,$usuariomodi,0);

      // empiezo la activacion del usuarios
      $resActivacion = $serviciosUsuarios->registrarSocio($email, $pass, $apellidopaterno.' '.$apellidomaterno, $nombre, $res);

      if ((integer)$resActivacion > 0) {

         echo '';
      } else {
         echo 'Hubo un error al insertar datos ';
      }
   } else {
      // error
      echo $error;
   }
}


function devolverImagen($nroInput) {

	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }

	  $datos = getimagesize($tmp_name);

	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);
}


?>
