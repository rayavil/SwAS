<?php

	$user = $_POST['usuario'];
	$pass = $_POST['password'];

	$json= file_get_contents("http://localhost/SwAS/app/index.php/usuario/".$user."/password/".$pass);
	$user=json_decode($json);
	$status=$user->STATUS;


	if ($status == "true") {
		$nombre=$user->nombre;
		$apellido=$user->app;
		session_start();
		$_SESSION['usuario'] = $nombre." ".$apellido;
		$result = array("STATUS" => "true");

	} if ($status == "false"){
		$result = array("STATUS" => "false");
	}


	echo json_encode($result);


 ?>