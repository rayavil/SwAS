<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

header("Access-Control-Allow-Headers: X-Requested-With");






require 'vendor/autoload.php';
$app = new \Slim\Slim();

$db = new mysqli("localhost","root","","dbauditorias");

//------------ CARRERAS ----------------------------------//

$app->get('/carreras', function () use($db, $app) {
	$query = $db->query ("Select * from carrera");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera["data"][]=$fila;
	}
	echo json_encode($carrera);
    
});

$app->get('/carrerasactivas', function () use($db, $app) {
	$query = $db->query ("Select * from carrera where activa = 1");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera["data"][]=$fila;
	}
	echo json_encode($carrera);
    
});


$app->get('/carreras/:id', function ($id) use($db, $app) {

	$query = $db->query ("Select * from carrera WHERE id_carrera = {$id}");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera[]=$fila;
	}
	echo json_encode($carrera);
    
});

$app->delete('/carreras/:id', function ($id) use($db, $app) {

	$delete = $db->query ("DELETE FROM carrera WHERE id_carrera = {$id}");
	if ($delete) {
		$result = array("estado" => "true");
	} else{
		$result = array("estado" => "false");
	}
	echo json_encode($result);
    
});


$app->post('/carreras', function () use($db, $app) {
	$query= "INSERT INTO carrera VALUES (NULL,"
			. "'{$app->request->post("corto")}',"
			. "'{$app->request->post("descripcion")}',"
			. "'{$app->request->post("activa")}'"
			. ")";

	$insert = $db->query($query);
	if ($insert) {
		
		$result = array ("STATUS" => "true", "message" => "carrera creada correctamente");
	} else {
		$result = array ("STATUS" => "false", "message" => "carrera no se ha creada");	
	}

	echo json_encode($result);
});


$app->put('/carreras/:id', function ($id) use($db, $app) {

	$query= "UPDATE carrera SET "
			. "corto = '{$app->request->post("corto")}',"
			. "descripcion = '{$app->request->post("descripcion")}',"
			. "activa = '{$app->request->post("activa")}'"
			. " WHERE id_carrera = {$id}";

	$update = $db->query($query);
	if ($update) {
		
		$result = array ("STATUS" => "true", "message" => "carrera creada correctamente");
	} else {
		$result = array ("STATUS" => "false", "message" => "carrera no se ha creada");	
	}
 	
 	echo $query;
	//echo json_encode($result);
    
});

//------------ CARRERAS ----------------------------------//

//------------ SERVICIOS ----------------------------------//

$app->get('/servicios', function () use($db, $app) {
	$query = $db->query ("Select * from servicios");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera["data"][]=$fila;
	}
	echo json_encode($carrera);
    
});

$app->get('/serviciosact', function () use($db, $app) {
	$query = $db->query ("Select * from servicios where serv_act = 1");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera[]=$fila;
	}
	echo json_encode($carrera);
    
});


$app->get('/servicios/:id', function ($id) use($db, $app) {

	$query = $db->query ("Select * from servicios WHERE id_servicio = {$id}");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera[]=$fila;
	}
	echo json_encode($carrera);
    
});

$app->delete('/servicios/:id', function ($id) use($db, $app) {

	$delete = $db->query ("DELETE FROM servicios WHERE id_servicio = {$id}");
	if ($delete) {
		$result = array("estado" => "true");
	} else{
		$result = array("estado" => "false");
	}
	echo json_encode($result);
    
});


$app->post('/servicios', function () use($db, $app) {
	$query= "INSERT INTO servicios VALUES (NULL,"
			. "'{$app->request->post("serv_descripcion")}',"
			. "'{$app->request->post("semestres")}',"
			. "'{$app->request->post("serv_area")}',"
			. "'{$app->request->post("serv_act")}'"
			. ")";

	$insert = $db->query($query);
	if ($insert) {
		
		$result = array ("STATUS" => "true");
	} else {
		$result = array ("STATUS" => "false");	
	}

	echo json_encode($result);
});


$app->put('/servicios/:id', function ($id) use($db, $app) {

	$query= "UPDATE servicios SET "
			. "serv_descripcion = '{$app->request->post("serv")}',"
			. "serv_semest = '{$app->request->post("semestre")}',"
			. "serv_area = '{$app->request->post("area")}',"
			. "serv_act = '{$app->request->post("serv_act")}'"
			. " WHERE id_servicio = {$id}";

	$update = $db->query($query);
	if ($update) {
		
		$result = array ("STATUS" => "true");
	} else {
		$result = array ("STATUS" => "false");	
	}
 	
 	//echo $query;
	echo json_encode($result);
    
});

//------------ SERVICIOS ----------------------------------//


//------------ ITEMS ----------------------------------//

$app->get('/items', function () use($db, $app) {
	$query = $db->query ("Select servicios.serv_descripcion, item.item_descripcion, item.item_activo, item.id_item from item INNER JOIN servicios ON item.id_servicio = servicios.id_servicio");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera["data"][]=$fila;
	}
	echo json_encode($carrera);
    
});


$app->get('/items/:id', function ($id) use($db, $app) {

	$query = $db->query ("Select * from item WHERE id_item = {$id}");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera[]=$fila;
	}
	echo json_encode($carrera);
    
});

$app->delete('/items/:id', function ($id) use($db, $app) {

	$delete = $db->query ("DELETE FROM item WHERE id_item = {$id}");
	if ($delete) {
		$result = array("estado" => "true");
	} else{
		$result = array("estado" => "false");
	}
	echo json_encode($result);
    
});


$app->post('/items', function () use($db, $app) {
	$query= "INSERT INTO item VALUES (NULL,"
			. "'{$app->request->post("id_servicio")}',"
			. "'{$app->request->post("item_descripcion")}',"
			. "'{$app->request->post("item_activo")}'"
			. ")";

	$insert = $db->query($query);
	if ($insert) {
		
		$result = array ("STATUS" => "true");
	} else {
		$result = array ("STATUS" => "false");	
	}

	echo json_encode($result);
});


$app->put('/items/:id', function ($id) use($db, $app) {

	$query= "UPDATE item SET "
			. "id_servicio = '{$app->request->post("id_servicio")}',"
			. "item_activo = '{$app->request->post("item_activo")}',"
			. "item_descripcion = '{$app->request->post("item_descripcion")}'"
			. " WHERE id_item = {$id}";

	$update = $db->query($query);
	if ($update) {
		
		$result = array ("STATUS" => "true");
	} else {
		$result = array ("STATUS" => "false");	
	}
 	
 	//echo $query;
	echo json_encode($result);
    
});

//------------ ITEMS END ----------------------------------//



//------------ ALUMNOS ----------------------------------//

$app->get('/alumnos', function () use($db, $app) {
	$query = $db->query ("SELECT * from alumnos ");
	$alumno= array();
	while ($fila = $query->fetch_assoc()) {
		$alumno["data"][]=$fila;
	}
	echo json_encode($alumno);
    
});


$app->get('/alumnos/:id', function ($id) use($db, $app) {

	$query = $db->query ("Select * from alumnos WHERE ctrl_alu = {$id}");
	$alumno= array();
	while ($fila = $query->fetch_assoc()) {
		$alumno[]=$fila;
	}
	if ($alumno) {
		$res = "true";
	} else{
		$res = "false";
	}
	echo json_encode($res);
    
});

$app->delete('/items/:id', function ($id) use($db, $app) {

	$delete = $db->query ("DELETE FROM item WHERE id_item = {$id}");
	if ($delete) {
		$result = array("estado" => "true");
	} else{
		$result = array("estado" => "false");
	}
	echo json_encode($result);
    
});


$app->post('/items', function () use($db, $app) {
	$query= "INSERT INTO item VALUES (NULL,"
			. "'{$app->request->post("id_servicio")}',"
			. "'{$app->request->post("item_descripcion")}',"
			. "'{$app->request->post("item_activo")}'"
			. ")";

	$insert = $db->query($query);
	if ($insert) {
		
		$result = array ("STATUS" => "true");
	} else {
		$result = array ("STATUS" => "false");	
	}

	echo json_encode($result);
});


$app->put('/items/:id', function ($id) use($db, $app) {

	$query= "UPDATE item SET "
			. "id_servicio = '{$app->request->post("id_servicio")}',"
			. "item_activo = '{$app->request->post("item_activo")}',"
			. "item_descripcion = '{$app->request->post("item_descripcion")}'"
			. " WHERE id_item = {$id}";

	$update = $db->query($query);
	if ($update) {
		
		$result = array ("STATUS" => "true");
	} else {
		$result = array ("STATUS" => "false");	
	}
 	
 	//echo $query;
	echo json_encode($result);
    
});

//------------ ALUMNOS END ----------------------------------//



//------------ USUARIOS ----------------------------------//

$app->get('(/usuario/:us)(/password/:pass)', function ($us,$pass) use($db, $app) {

	$consulta = "Select * from usuarios WHERE user = '{$us}' AND password = '{$pass}' AND activo = 1";
	//echo $consulta."</br>";
	$query = $db->query ($consulta);
	$result= array();

	$usuario="false";
	$nombre="";
	$app="";

	while ($fila = $query->fetch_assoc()) {
			$usuario=$fila;
			$nombre = $fila["nombre"];
			$app = $fila["apellido"];

		}

	if ($usuario) {		
		$result = array("STATUS" => "true", "nombre" => "$nombre", "app"=>"$app");
	} if ($usuario == "false") {
		$result = array("STATUS" => "false");
		
	}
	echo json_encode($result);
	
    
});



$app->get('/items', function () use($db, $app) {
	$query = $db->query ("Select servicios.serv_descripcion, item.item_descripcion, item.item_activo, item.id_item from item INNER JOIN servicios ON item.id_servicio = servicios.id_servicio");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera["data"][]=$fila;
	}
	echo json_encode($carrera);
    
});


$app->get('/items/:id', function ($id) use($db, $app) {

	$query = $db->query ("Select * from item WHERE id_item = {$id}");
	$carrera= array();
	while ($fila = $query->fetch_assoc()) {
		$carrera[]=$fila;
	}
	echo json_encode($carrera);
    
});

$app->delete('/items/:id', function ($id) use($db, $app) {

	$delete = $db->query ("DELETE FROM item WHERE id_item = {$id}");
	if ($delete) {
		$result = array("estado" => "true");
	} else{
		$result = array("estado" => "false");
	}
	echo json_encode($result);
    
});


$app->post('/items', function () use($db, $app) {
	$query= "INSERT INTO item VALUES (NULL,"
			. "'{$app->request->post("id_servicio")}',"
			. "'{$app->request->post("item_descripcion")}',"
			. "'{$app->request->post("item_activo")}'"
			. ")";

	$insert = $db->query($query);
	if ($insert) {
		
		$result = array ("STATUS" => "true");
	} else {
		$result = array ("STATUS" => "false");	
	}

	echo json_encode($result);
});


$app->put('/items/:id', function ($id) use($db, $app) {

	$query= "UPDATE item SET "
			. "id_servicio = '{$app->request->post("id_servicio")}',"
			. "item_activo = '{$app->request->post("item_activo")}',"
			. "item_descripcion = '{$app->request->post("item_descripcion")}'"
			. " WHERE id_item = {$id}";

	$update = $db->query($query);
	if ($update) {
		
		$result = array ("STATUS" => "true");
	} else {
		$result = array ("STATUS" => "false");	
	}
 	
 	//echo $query;
	echo json_encode($result);
    
});

//------------ USUARIOS END ----------------------------------//








//------------ SISTEMA  ----------------------------------//


$app->get('/sistema', function () use($db, $app) {
	$query = $db->query ("Select * FROM configuracion");
	$configuracion= array();
	while ($fila = $query->fetch_assoc()) {
		$configuracion[]=$fila;
	}
	echo json_encode($configuracion);
    
});


$app->get('/sistema/:id', function ($id) use($db, $app) {

	$query = $db->query ("Select * from item WHERE id_item = {$id}");
	$configuracion= array();
	while ($fila = $query->fetch_assoc()) {
		$configuracion[]=$fila;
	}
	echo json_encode($configuracion);
    
});




$app->put('/sistema/:id', function ($id) use($db, $app) {

	$query= "UPDATE configuracion SET "
			. "institucion = '{$app->request->post("institucion")}',"
			. "departamento = '{$app->request->post("departamento")}',"
			. "encargado = '{$app->request->post("encargado")}'"
			. " WHERE id_conf = {$id}";

	$update = $db->query($query);
	if ($update) {
		
		$result = array ("STATUS" => "true");
	} else {
		$result = array ("STATUS" => "false");	
	}
 	
 	//echo $query;
	echo json_encode($result);
    
});

//------------ SISTEMA  END ----------------------------------//



//------------ AUDITORIAS ----------------------------------//

$app->get('/auditorias', function () use($db, $app) {
	$query = $db->query ("Select * from auditoria");
	$auditoria= array();
	while ($fila = $query->fetch_assoc()) {
		$auditoria["data"][]=$fila;
	}
	echo json_encode($auditoria);
    
});


$app->get('/auditoriaact', function () use($db, $app) {
	$query = $db->query ("Select * from auditoria where actual = 1");
	$auditoria= array();
	while ($fila = $query->fetch_assoc()) {
		$auditoria["data"][]=$fila;
	}
	if (!$auditoria) {
		$resultado = "";
	} if ($auditoria) {
		$resultado = $auditoria;
	}
	echo json_encode($resultado);
    
});

$app->get('/auditorias/:id', function ($id) use($db, $app) {

	$query = $db->query ("Select * from auditoria WHERE no_auditoria = {$id}");
	$auditoria= array();
	while ($fila = $query->fetch_assoc()) {
		$auditoria[]=$fila;
	}
	echo json_encode($auditoria);
    
});




$app->delete('/auditorias/:id', function ($id) use($db, $app) {


	$delete = $db->query ("DELETE FROM auditoria WHERE no_auditoria = {$id} AND actual <> 1 ");
	//echo $delete;
	$afectados = $db->affected_rows;
	if ($afectados == 1) {
		$result = array("estado" => "true");
	} else{
		$result = array("estado" => "false");
	}
	echo json_encode($result);
    
});


$app->post('/auditorias', function () use($db, $app) {
	$query= "INSERT INTO auditoria VALUES (NULL,NULL,NULL,"
			. "{$app->request->post("anio")},"
			. "'{$app->request->post("ciclo")}',"
			. "'{$app->request->post("descripcion")}',"
			. "'{$app->request->post("observacion")}',"
			. "{$app->request->post("estado")}"
			. ",NULL)";

	$insert = $db->query($query);
	if ($insert) {
		
		$result = "true";
	} else {
		$result = "false";	
	}

	echo json_encode($result);
});


$app->put('/auditorias/:id', function ($id) use($db, $app) {


	$estado = $app->request->post("estado");
	if ( $estado == 0 ) {
		$query= "UPDATE auditoria SET "
			. "audi_obs = '{$app->request->post("descripcion")}',"
			. "audi_descripcion = '{$app->request->post("observacion")}',"
			. "actual = '{$app->request->post("estado")}'"
			. " WHERE no_auditoria = {$id}";

		$update = $db->query($query);
			if ($update) {
				
				$result = "true";
			} else {
				$result = "false";	
			}
	} if ($estado == 1) {

			$queryNew = $db->query ("Select * from auditoria WHERE actual = 1");
			$auditoria= array();

			while ($fila = $queryNew->fetch_assoc()) {
				$auditoria[]=$fila;
			}

			echo $fila;
				if ($auditoria) {
					$result = "false";
					echo $fila;
				} elseif (!$auditoria) {
					$query= "UPDATE auditoria SET "
						. "audi_obs = '{$app->request->post("descripcion")}',"
						. "audi_descripcion = '{$app->request->post("observacion")}',"
						. "actual = '{$app->request->post("estado")}'"
						. " WHERE no_auditoria = {$id}";

					$update = $db->query($query);
						if ($update) {
							
							$result = "true";
						} else {
							$result = "false";	
						}
				}

	}
	
	

 	//echo $query;
	echo json_encode($result);
    
});



//Consulta a el promedio de todas las auditorias

$app->get('/graph-all-auditorias', function () use($db, $app) {
	$query = $db->query ("Select * from resauditorias");
	$auditoriaGra= array();
	while ($fila = $query->fetch_assoc()) {
		$auditoriaGra[]=$fila;
	}
	echo json_encode($auditoriaGra);
    
});

//------------ AUDITORIAS END ----------------------------------//








$app->run();