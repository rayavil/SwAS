<?php
    $pagina = "Auditorias";
    include ('commons/head.php');

	$numAuditoria = $_POST['auditorianum'];
	$anio         = $_POST['anio'];
	$ciclo        = $_POST['ciclo'];
	$api          =$_POST['api'];

	///-----consultar servicios
    $url= $api.'/serviciosact';
	$json = file_get_contents($url);
	$datos = json_decode($json, true);
	///------fin
    
    ///----consultar total de auditoria
    $url2= $api.'/graph-general/'.$numAuditoria;
    $json2 = file_get_contents($url2);
    $tablaAuditoria = json_decode($json2, true);
    ////----------


	//si se intenta llegar directamente lo regresamos a auditorias
    if ($numAuditoria== "") {
    	 header("Location: auditorias.php");
    }
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




    //------------------------Cargar selects
    
    function contarAlumnos(){
        var numeroauditoria = <?php echo $numAuditoria; ?>;
        $.ajax({
                                dataType: "json",
                                url: api+"/graph-totalalumnos/"+numeroauditoria,
                                type: 'get',
                                
                            
                            beforeSend: function () {
                                
                            },

                            error: function(xhr) { // if error occured
                                    

                            },
                            success: function(data)
                           {
                                //alert(data);
                                var j=0;
                                $.each(data, function(i,item){
                                    j=j+1;
                                    //alert(j);
                                    //alert(data[i].corto);
                                   // var res = data[i]; 
                                   //document.getElementById("count").innerHTML = j;
                                                                     
                                })
                                //alert(option);
                                $('#lines').animateNumber({ number: j }, 2000);
                               
                            

                                
                           }
                       });
    }

 $( document ).ready(function() {
    
    contarAlumnos();
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



    //------------------------Cargar selects end

     
     //------------------------Crear Graficas
    function crearGrafica(servicioElegido,lugarId){
    var audNumero ="<?php echo $numAuditoria; ?>";
  	var options = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '      '
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{}]
    };
    
    var url =  api+'/graphaud/'+audNumero+'/serv/'+servicioElegido;
    $.getJSON(url,  function(data) {
    	if (data=="") {
    		$('#contenido').html('<div class="col-sm-8 col-sm-offset-2 text-center"><div class="alert alert-warning" role="alert">Al parecer aún no hay información sobre esta auditoria.<br><img src="img/emo-triste.png" style="clear:left;"  width="50px" alt="Triste! :/"> </div></div>');
    	}
        options.series[0].data = data;
        var chart = new Highcharts.Chart(lugarId,options);
    });

    }
	
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
		                 <a class="btn btn-primary" href="auditorias.php" role="button"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>Regresar</a>
		                </div>
                        <!-- END PAGE HEAD -->

                        <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                		<div class="row">
                          <div class="col-sm-8">
                                
                                <!-- START WIDGET SLIDER -->
                                <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" >
                                <div class="widget-item-left">
                                    <span class="fa fa-check-circle"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $ciclo.' - '.$anio; ?> </div>
                                    <div class="widget-title">Auditoria de Servicios</div>
                                  
                                </div>      
                                
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            <!-- END WIDGET SLIDER -->
                          </div>


                          <div class="col-sm-4">
                                
                                <!-- START WIDGET SLIDER -->
                                <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" >
                                <div class="widget-item-left">
                                    <span class="fa fa-user"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"> <div id="lines">0</div></div>
                                    <div class="widget-title">Estudiantes Auditados</div>
                                    <div class="widget-subtitle">Solo para esta muestra.</div>
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
                                        <h3 class="panel-title">Reporte General</h3>
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
                                                    foreach($tablaAuditoria as $tabla) { 
                                                        if ($tabla['y'] >0 and $tabla['y'] < 2) {
                                                            $evaluacion ="danger";
                                                        } if ($tabla['y'] >2 and $tabla['y'] < 3) {
                                                            $evaluacion ="warning";
                                                        } if ($tabla['y'] >3 and $tabla['y'] < 5) {
                                                            $evaluacion ="success";
                                                        } 

                                                       echo "<tr>
                                                                <th>".$tabla['serv_descripcion']."</th>
                                                                <td class='resultado-tabla label label-".$evaluacion."'>".$tabla['y']."</td>"; 
                                                        

                                                       
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

                    <div class="row" id="contenido">


                    <?php 
                    	foreach($datos as $dato) { 
                    		
                    			 
                    		echo "<script>crearGrafica(".$dato['id_servicio'].",'".$dato['serv_descripcion']."');</script>";
                    	 	echo '<div class="col-md-6">
                            <!-- START LINE CHART -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">'.$dato['serv_descripcion'].'</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="'.$dato['serv_descripcion'].'"></div>
                                </div>
                            </div>
                            <!-- END LINE CHART -->
                        </div>';
						  
						   //echo $dato['id_servicio'];
						}

                    ?>
                        
                        
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


