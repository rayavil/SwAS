<?php
    $pagina = "Configuracion";
    include ('commons/head.php');

?>


<script>


$(document).ready(function() {
    var tabla = "/sistema"

    $.ajax({
            dataType: "json",
            url: api+tabla,
            type: 'GET',
                      
            beforeSend: function () {
                $(".actualizado").html(" <div class='progress'><div class='progress-bar progress-bar-striped active'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>Cargando información.. </div></div>");
            },

            error: function(xhr) { // if error occured
                

               $(".actualizado").html("<div class='alert alert-danger' role='alert'><strong>Ocurrió un error al cargar los datos </strong> <br> Intente reiniciando el navegador.</div>");


            },
            success: function(data)
           {
                //alert(data);

                $.each(data, function(i,item){
                    $(".actualizado").html(" ");
                    //alert(data[i].corto);
                    $('#institucion').val(data[i].institucion);
                    $('#departamento').val(data[i].departamento);
                    $('#encargado').val(data[i].encargado);
                    $('#id').val(data[i].id_conf);
                    
                   
                     
                })
                
                // $('#ecorto').val('');    

               

           }
       });





function muestraError(lugar){
          $.notify({
                        title: "<strong>Error:</strong> ",
                        icon: 'glyphicon glyphicon-star',
                        message: "No se han agregado los registros, el servidor no responde.",
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        }
                    },{
                        type: 'danger',
                        element: lugar
                    });
                  
    }

    function muestraCorrecto(lugar){
        $.notify({
                        title: "<strong>Correcto:</strong> ",
                        icon: 'glyphicon glyphicon-star',
                        message: "Se guardo correctamete!!.",
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        }
                    },{
                        type: 'success',
                        element: lugar
                    });
                  

    }



    //-----------------------------Guardar Formulario NUEVO ----------------------
            var validar = $("#guardar").validate({
                ignore: [],
                rules: {                                            
                        institucion: {
                                required: true,
                                minlength: 2
                        },
                        departamento: {
                                required: true,
                                minlength: 2,
                                maxlength: 240
                        },
                        encargado: {
                                required: true,
                                minlength: 2,
                                maxlength: 140
                        }
                },
                messages:{
                    institucion: "No deje el campo en blanco, se requiere un nombre.",
                    encargado: "No deje el campo en blanco, introduzca el nombre de un encargado de este proceso.",
                    departamento: "Debe introducir un departamento encargado del sistema.)"
                },
                submitHandler: function(form){
                     var url = api+tabla; // El script a dónde se realizará la petición.
                     var institucion = $('#institucion').val();
                     var encargado = $('#encargado').val();
                     var departamento = $('#departamento').val();
                     var id_conf = $('#id').val();
                     
                     var parametros = {
                        "institucion" : institucion,
                        "encargado" : encargado,
                        "departamento" : departamento
                     };
                        $.ajax({
                               data: parametros,
                               type: "PUT",
                               url: url+"/"+id_conf,

                               beforeSend: function () {
                                        $(".actualizado").html(" <div class='progress'><div class='progress-bar progress-bar-striped active'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>Guardando.. </div></div>");
                                },

                                error: function(xhr) { // if error occured
                                    


                                   // $("#respuesta").html("Ocurrio un error al guardar los datos, intente de nuevo.");
                                   // $(placeholder).append(xhr.statusText + xhr.responseText);
                                   // $(placeholder).removeClass('loading');
                                    $(".actualizado").html(' ');
                                   muestraError(".actualizado");
                                  


                                },

                               success: function(data)
                               {    





                                    $(".actualizado").html(' ');
                                  // $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
                                   // $("#muestraCarreras").load('sw/carreras/carreras.php');




                                    var obj = JSON.parse(data);
                                              
                                    var res = obj['STATUS'];
                                    $(".actualizado").html(" ");
                                    //alert(data[i].corto);
                                   
                                   // alert(data[i]);
                                    
                                    //alert(data[i].activa);
                                    if (res == "true") {
                                        //$("#eactiva").prop("checked", true);
                                         $.alert({
                                            title: 'Correcto!',
                                            icon: 'fa fa-check-circle',
                                            content: 'Datos Actualizados. :)',
                                            confirmButton: 'Ok'
                                            
                                            
                                        });


                                    }else if (res == "false"){

                                         $.alert({
                                            title: 'Error!',
                                            icon: 'fa fa-exclamation-triangle',
                                            content: 'No pudimos actualizar los datos, revise la información. :(',
                                            confirmButton: 'Ok'
                                            
                                        });
                                        
                                        
                                    }

                                     
                                
                                  
                                                   
                                  


                               }
                             });

                        return false; // Evitar ejecutar el submit del formulario.
                 


                }

                });   

//-----------------------------Guardar Formulario NUEVO  FIN----------------------  



})
    

   
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
                        <div class="page-head">        
                            <div class="page-head-text">
                                <h1><?php echo strtoupper($pagina);?> </h1>
                                <p class="page-head-subtitle">Aquí encontrarás todo lo referente a la configuración basica del sistema.</p>
                            </div>
                                        
                        </div>
                        <!-- END PAGE HEAD -->
                
                        <!-- PAGE CONTENT TABBED -->
                        <div class="page-content-wrap">
                        <div class="row">
                            
                        </div>                
                
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-primary panel-principal">
                                 <div class="panel-heading">
                                    
                                    <h3 class="panel-title"><span class="fa fa-gears"></span> Configuración</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                      <div class="col-sm-6">
                                      
                                        <form id="guardar" role="form" class="form-material">
                                        <div class="actualizado"></div>
                                        <input type="hidden" class="form-control" id="id" name="id">
                                            <div class="form-group">

                                                <input type="text" class="form-control" name="institucion" id="institucion" placeholder="Instituto / universidad " required>                                            
                                                <span class="form-bar"></span>
                                                <label for="institucion">Institución a la que pertenece el sistema.</label>
                                            </div>
                                            <div class="form-group">  
                                                <input type="text" class="form-control" name="departamento" id="departamento" placeholder="Nombre del departamento">                                            
                                                <span class="form-bar"></span>
                                                <label for="departamento">Departamento encargado del sistema.</label>        
                                            </div>
                                            <div class="form-group">  
                                                <input type="text" class="form-control" name="encargado" id="encargado" placeholder="Encargado">                                            
                                                <span class="form-bar"></span>
                                                <label for="encargado">Nombre de la persona encargada del sistema.</label>        
                                            </div>
                                            <button class="btn btn-primary pull-right" type="submit">Guardar</button>

                                                                                   
                                                                                   
                                            
                                        </form> 
                                      </div>
                                      <div class="col-sm-6">
                                          <div class="form-group">
                                            <div class="col-md-12">

                                            <div class="row">
                                               <div class="col-sm-12">
                                                  <form id="imagen-form" method="post" action="commons/image-ajax.php" enctype="multipart/form-data">
                                                  <label>Logotipo Institucional</label>
                                                  <input name="file" type="file" multiple class="file" data-preview-file-type="any" accept="image/png"/>
                                                  </form>   
                                                </div>
                                              </div>

                                             <div class="row">
                                               <div class="col-sm-8 col-sm-offset-2">
                                                  <div id="respuesta">
                                                    <img src="img/logotipo.png"  class="img-responsive img-thumbnail">
                                                  </div>
                                                </div>
                                              </div>
                                        
                                            </div>
                                        </div>
                                        
                                      </div>

                                    </div>
                                    
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->
                        <!-- END PAGE CONTENT TABBED -->
                
            </div>     
            
                 
            <!-- END PAGE CONTENT -->
        </div>
       
        <!-- END PAGE CONTAINER -->




        





       
        
        


<?php
    include ('commons/footer.php');
    include ('commons/endscripts.php');
    include ('commons/end.php');
?>






