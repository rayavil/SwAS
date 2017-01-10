<?php
    $pagina = "Areas";
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
                                    <div class="table-responsive">
                                        <table class="table datatable table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="10%">ID</th>
                                                    <th>Descripción</th>
                                                    <th>Estado</th>
                                                    <th width="20%">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Subdireccion</td>
                                                    <td><span class="label label-success label-form">Activo</span></td>
                                                    <td>
                                                        <button class="btn btn-default btn-rounded btn-condensed btn-sm"><span class="fa fa-pencil"></span></button>
                                                        <button class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Vinculación</td>
                                                    <td><span class="label label-success label-form">Activo</span></td>
                                                    <td>
                                                        <button class="btn btn-default btn-rounded btn-condensed btn-sm"><span class="fa fa-pencil"></span></button>
                                                        <button class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Comunicación</td>
                                                    <td><span class="label label-danger label-form">Inactivo</span></td>
                                                    <td>
                                                        <button class="btn btn-default btn-rounded btn-condensed btn-sm"><span class="fa fa-pencil"></span></button>
                                                        <button class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
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
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Nombre:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control"/>
                                                    </div>                                            
                                                    <span class="help-block">Nombre del Área Auditada</span>
                                                </div>
                                    </div>
                                     <div class="form-group">
                                                <label class="col-md-3 control-label">Estado:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="form-group">
                                                        <div class="col-md-6">                                    
                                                            <label class="check"><input type="radio" class="iradio" name="activo" checked="checked"/> Activo</label>
                                                        </div>
                                                        <div class="col-md-6">                                    
                                                            <label class="check"><input type="radio" class="iradio" name="activo" /> Inactivo</label>
                                                        </div>
                                                       
                                                    </div>                                        
                                                    <span class="help-block">Si el estado se encuentra inactivo el Area no sera visible al asignar Servicio a Auditar.</span>
                                                </div>
                                    </div>



                                </div>
                                <div class="panel-footer">
                                     <button class="btn btn-default">Limpiar</button>                                    
                                    <button class="btn btn-success pull-right">Guardar</button>
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





