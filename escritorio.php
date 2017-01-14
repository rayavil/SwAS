<?php
    $pagina = "Escritorio";
    include ('commons/head.php');

?>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <?php
                include ('commons/menu.php');

            ?>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                 <?php
                    include ('commons/menux.php');

                ?>
                <!-- END X-NAVIGATION VERTICAL -->                     
                
                        <!-- START BREADCRUMB -->
                        <ul class="breadcrumb push-down-0">
                            <li><a href="#">Inicio</a></li>
                          
                            <li class="active">Áreas</li>
                        </ul>
                <!-- END BREADCRUMB -->                
                                
                        <!-- START PAGE HEAD -->
                        <div class="page-head">        
                            <div class="page-head-text">
                                <h1><?php  echo $pagina; ?></h1>
                                <p class="page-head-subtitle">Las <strong>Áreas Auditadas</strong> son las que tienen a su cargo un <strong>Servicio a Auditar</strong> en la institución.</p>
                            </div>
                                        
                        </div>
                        <!-- END PAGE HEAD -->
                
                        <!-- PAGE CONTENT TABBED -->
                        <div class="page-content-wrap">
                        <div class="row">
                            
                        </div>                
                
                    <div class="row">
                        <div class="col-md-8">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-primary">
                                 <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-list-ul"></span> Listado</h3>
                                </div>
                                <div class="panel-body">
                                    Algo
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->
                        <!-- END PAGE CONTENT TABBED -->
                
            </div>     
            <form class="form-horizontal">
            <div class="col-md-4">
                <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-plus-circle"></span> Agregar nueva</h3>
                                </div>
                                <div class="panel-body">
                                    
                                     Woow




                                </div>
                                <div class="panel-footer">
                                     pie
                                </div>
                            </div>
            </div>
            </form>       
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        


<?php
    include ('commons/endscripts.php');
    include ('commons/end.php');
?>





