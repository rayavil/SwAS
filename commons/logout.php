<?php
	session_start(); //verificamos haber llamado la funcion session
	unset($_SESSION); //elimina el array, sino queda gastando memoria
	session_destroy();//función de eliminación en sí de la sesión
	header("Location: ../index.php");
?>