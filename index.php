<?php 
    session_start();
    if (isset($_SESSION['usuario'])) {
      header("Location: carreras.php");
    }

?>
<!DOCTYPE html>
<html lang="es" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Inicio de Sesión</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
         <link rel="stylesheet" type="text/css" id="theme" href="js/plugins/confirm/jquery-confirm.min.css"/>
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type='text/javascript' src='js/plugins/confirm/jquery-confirm.min.js'></script>

        <script type="text/javascript" src="js/conf.js"></script>       

        
       
        <!-- EOF CSS INCLUDE -->                                     
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Iniciar Sesión:</strong></div>
                    <div class="loading"></div>
                    <form id="login" class="form-horizontal" >
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="usuario" name="usuario" type="text" class="form-control" placeholder="Usuario"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="pass" name="pass" type="password" class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Olvidó la contraseña?</a>
                        </div>
                        <div class="col-md-6">
                            <button id="enviar" class="btn btn-info btn-block"><i class="glyphicon glyphicon-log-in"></i> Entrar</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; <label class="fecha"></label> - Software de Auditoria de Servicios - RAG
                    </div>
                    
                </div>
            </div>
            
        </div>


        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>
         <script type="text/javascript" src="commons/verif.js"></script>
    </body>
</html>






