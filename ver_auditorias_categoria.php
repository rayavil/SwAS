<?php
    $pagina = "Auditorias";
    include ('commons/head.php');



    $numAuditoria    = $_POST['auditorianum'];
    $categoria       = $_POST['categoria'];
    $nombreCategoria = $_POST['nombreCategoria'];
    $api             =$_POST['api'];

        //si se intenta llegar directamente lo regresamos a auditorias
    if ($numAuditoria== "") {
         header("Location: auditorias.php");
    }
    
    ///----consultar promedio por item
    $url2= $api.'/grap-item/'.$numAuditoria.'/serv/'.$categoria ;
   // echo $url2;
    $json2 = file_get_contents($url2);
    $tablaServicios = json_decode($json2, true);
    ////----------



?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="js/plugins/animate-number/jquery.animateNumber.min.js" ></script>

		<style type="text/css">
            ${demo.css}
		</style>


<script type="text/javascript">




    

 $( document ).ready(function() {
    

    // $('#count').html(i);
    // 
    
    Highcharts.chart('reportegral', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: ' '
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Valor'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
    
    
     

});



    //------------------------crear grafica


		</script>



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
                        </ul>
                <!-- END BREADCRUMB -->                
                                
                        <!-- START PAGE HEAD -->
                        <div class="page-title">                    
		                    <h2><span class="fa fa-bar-chart-o"></span> Informe de resultados </h2><br>
		                </div>
		                 <div class="page-title">  
		                 <a class="btn btn-primary" href="#" onclick="window.history.back();" role="button"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>Regresar</a>
		                </div>
                        <!-- END PAGE HEAD -->

                        <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                		<div class="row">
                          <div class="col-sm-12">
                                
                                <!-- START WIDGET SLIDER -->
                                <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" >
                                <div class="widget-item-left">
                                    <span class="fa fa-list-alt"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $nombreCategoria; ?> </div>
                                    <div class="widget-title">Visualizando todos los elementos del Servicio </div>
                                  
                                </div>      
                                
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            <!-- END WIDGET SLIDER -->
                          </div>

	                     </div>

                    <div class="row">
                        <div class="col-sm-12">

                                <!-- START LINE CHART -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Promedio por Item: </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div id="reportegral" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                                            <table id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Valor</th>

                                                        
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    foreach($tablaServicios as $tabla) { 
                                                        if ($tabla['promedio'] >0 and $tabla['promedio'] < 2) {
                                                            $evaluacion ="danger";
                                                        } if ($tabla['promedio'] >2 and $tabla['promedio'] < 3) {
                                                            $evaluacion ="warning";
                                                        } if ($tabla['promedio'] >3 and $tabla['promedio'] < 5) {
                                                            $evaluacion ="success";
                                                        } 

                                                       echo "<tr>
                                                                <th>".$tabla['item_descripcion']."</th>
                                                                <td class='resultado-tabla label label-".$evaluacion."'>".$tabla['promedio']."</td>"; 
                                                        

                                                       
                                                        echo "</tr>";
                                                    }
                                                ?>
                                                    
                                                   
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                                <!-- END LINE CHART -->
                                          
                       </div>
                    </div>
                 
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->  
                
                     
                                       
                
                   
                            
            
            
                 
            <!-- END PAGE CONTENT -->
        </div>
       
        <!-- END PAGE CONTAINER -->
</div>


       




        
        
        

<?php
    include ('commons/footer.php');
    include ('commons/endscripts.php');
    include ('commons/end.php');
?>
