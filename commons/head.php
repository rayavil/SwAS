<?php 
    session_start();
    if (!isset($_SESSION['usuario'])) {
      header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>        
        <!-- META SECTION -->
        <title><?php echo $pagina ?> - Auditoría de Servicios</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-serenity.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css"/>

        <link rel="stylesheet" type="text/css" id="theme" href="js/plugins/confirm/jquery-confirm.min.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="js/plugins/datatables/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="css/personalizado.css"/>
        

        <!-- EOF CSS INCLUDE -->     


                <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>  
        <script type="text/javascript" src="js/conf.js"></script>       
       
        <!-- END PLUGINS -->                     
    </head>

    <body>
