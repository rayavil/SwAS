<?php
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
                                <h1>ÁREAS</h1>
                                <p class="page-head-subtitle">Las <strong>Áreas Auditadas</strong> son las que tienen a su cargo un <strong>Servicio a Auditar</strong> en la institución.</p>
                            </div>
                            <div class="page-head-controls">
                                <button class="btn btn-success btn-rounded"><span class="fa fa-plus-circle"></span> Agregar</button> 
                                
                            </div>                    
                        </div>
                        <!-- END PAGE HEAD -->
                
                        <!-- PAGE CONTENT TABBED -->
                        <div class="page-tabs">
                            <a href="#first-tab" class="active">First tab</a>
                            <a href="#second-tab">Second tab</a>                    
                        </div>
                        
                        <div class="page-content-wrap page-tabs-item active" id="first-tab">
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h3>Custom Header</h3>
                                            <p>Ca be used with subtitle and some extra controls floated right. Its also supported with tabbed layout.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        <div class="page-content-wrap page-tabs-item" id="second-tab">
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            Second tab content
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>                
                        <!-- END PAGE CONTENT TABBED -->
                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        


<?php
    include ('commons/endscripts.php');
    include ('commons/end.php');
    
?>





