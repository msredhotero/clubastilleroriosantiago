<?php

session_start();

include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');
include ('../includes/funcionesUsuarios.php');


$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();
$serviciosUsuarios  		= new ServiciosUsuarios();


$tabla = $_GET['tabla'];
$draw = $_GET['sEcho'];
$start = $_GET['iDisplayStart'];
$length = $_GET['iDisplayLength'];
$busqueda = $_GET['sSearch'];


$idcliente = 0;

if (isset($_GET['idcliente'])) {
	$idcliente = $_GET['idcliente'];
} else {
	$idcliente = 0;
}


$referencia1 = 0;

if (isset($_GET['referencia1'])) {
	$referencia1 = $_GET['referencia1'];
} else {
	$referencia1 = 0;
}

$colSort = (integer)$_GET['iSortCol_0'] + 2;
$colSortDir = $_GET['sSortDir_0'];

function armarAcciones($id,$label='',$class,$icon) {
	$cad = "";

	for ($j=0; $j<count($class); $j++) {
		$cad .= '<button type="button" class="btn '.$class[$j].' btn-circle waves-effect waves-circle waves-float '.$label[$j].'" id="'.$id.'">
				<i class="material-icons">'.$icon[$j].'</i>
			</button> ';
	}

	return $cad;
}

function armarAccionesDropDown($id,$label='',$class,$icon) {
	$cad = '<div class="btn-group">
					<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						 Accions <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">';

	for ($j=0; $j<count($class); $j++) {
		$cad .= '<li><a href="javascript:void(0);" id="'.$id.'" class=" waves-effect waves-block '.$label[$j].'">'.$icon[$j].'</a></li>';

	}

	$cad .= '</ul></div>';

	return $cad;
}

switch ($tabla) {
	case 'aseguradoras':
		$datos = $serviciosReferencias->traerAseguradorasajax($length, $start, $busqueda,$colSort,$colSortDir);

		$resAjax = $datos[0];
		$res = $datos[1];

		$label = array('btnModificar','btnEliminar');
		$class = array('bg-orange','bg-red');
		$icon = array('edit','remove');


		$indiceID = 0;
		$empieza = 1;
		$termina = 1;
	break;
	case 'empleados':
		$datos = $serviciosReferencias->traerEmpleadosajax($length, $start, $busqueda,$colSort,$colSortDir);

		$resAjax = $datos[0];
		$res = $datos[1];

		$label = array('btnModificar','btnEliminar');
		$class = array('bg-orange','bg-red');
		$icon = array('edit','remove');


		$indiceID = 0;
		$empieza = 1;
		$termina = 3;
	break;
	case 'metodopago':
		$datos = $serviciosReferencias->traerMetodopagoajax($length, $start, $busqueda,$colSort,$colSortDir);

		$resAjax = $datos[0];
		$res = $datos[1];

		$label = array('btnModificar','btnEliminar');
		$class = array('bg-orange','bg-red');
		$icon = array('edit','remove');


		$indiceID = 0;
		$empieza = 1;
		$termina = 1;
	break;
	case 'tiposervicios':
		$datos = $serviciosReferencias->traerTiposerviciosajax($length, $start, $busqueda,$colSort,$colSortDir);

		$resAjax = $datos[0];
		$res = $datos[1];

		$label = array('btnModificar','btnEliminar');
		$class = array('bg-orange','bg-red');
		$icon = array('edit','remove');


		$indiceID = 0;
		$empieza = 1;
		$termina = 1;
	break;
	case 'pacientes':
		$datos = $serviciosReferencias->traerPacientesajax($length, $start, $busqueda,$colSort,$colSortDir);

		$resAjax = $datos[0];
		$res = $datos[1];

		$label = array('btnModificar','btnEliminar');
		$class = array('bg-orange','bg-red');
		$icon = array('edit','remove');


		$indiceID = 0;
		$empieza = 1;
		$termina = 7;
	break;
	case 'citas':
		$datos = $serviciosReferencias->traerCitasajax($length, $start, $busqueda,$colSort,$colSortDir);

		$resAjax = $datos[0];
		$res = $datos[1];

		$label = array('btnModificar','btnEliminar');
		$class = array('bg-orange','bg-red');
		$icon = array('edit','remove');


		$indiceID = 0;
		$empieza = 1;
		$termina = 7;
	break;

	case 'usuarios':

		//die(var_dump($_GET['sSearch_0']));

		$datos = $serviciosUsuarios->traerUsuariosajax($length, $start, $busqueda,$colSort,$colSortDir, $_GET['sSearch_0']);

		$resAjax = $datos[0];
		$res = $datos[1];

		$label = array('btnModificar','btnEliminar','btnInformacion');
		$class = array('bg-amber','bg-red','bg-teal');
		$icon = array('create','delete','add_a_photo');
		$indiceID = 0;
		$empieza = 1;
		$termina = 6;

	break;

	default:
		// code...
		break;
}


$cantidadFilas = mysql_num_rows($res);


header("content-type: Access-Control-Allow-Origin: *");

$ar = array();
$arAux = array();
$cad = '';
$id = 0;
	while ($row = mysql_fetch_array($resAjax)) {
		//$id = $row[$indiceID];
		// forma local utf8_decode
		for ($i=$empieza;$i<=$termina;$i++) {
			array_push($arAux, utf8_decode($row[$i]));
		}

		if (($tabla == 'postulantes') || ($tabla == 'ventas') || ($tabla == 'postulanteshistorico') || ($tabla == 'asesores') || ($tabla == 'asociadostemporales') || ($tabla == 'asociados') || ($tabla == 'clientes') || ($tabla == 'cuestionario') || ($tabla == 'preguntascuestionario') || ($tabla == 'respuestascuestionario')) {
			array_push($arAux, armarAccionesDropDown($row[0],$label,$class,$icon));
		} else {
			array_push($arAux, armarAcciones($row[0],$label,$class,$icon));
		}


		array_push($ar, $arAux);

		$arAux = array();
		//die(var_dump($ar));
	}

$cad = substr($cad, 0, -1);

$data = '{ "sEcho" : '.$draw.', "iTotalRecords" : '.$cantidadFilas.', "iTotalDisplayRecords" : 10, "aaData" : ['.$cad.']}';

//echo "[".substr($cad,0,-1)."]";
echo json_encode(array(
			"draw"            => $draw,
			"recordsTotal"    => $cantidadFilas,
			"recordsFiltered" => $cantidadFilas,
			"data"            => $ar
		));

?>
