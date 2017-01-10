    
<?php
$pagina = "Carreras";
    include ('commons/head.php');

?>


<script>


$(document).ready(function() {
    var tabla = "/carreras";

   var tablaCarrera = $('#verCarreras').DataTable( {
        "destroy": true,
        "fixedHeader": true,
        "scrollY": "500px",
        "scrollCollapse": true,
        "paging": false,
        select: {
            style: 'single'
        },
        "language": {
            url: '//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
        },
        dom: 'Bfrtip',
        buttons: [
            
            { extend: 'copy', text: 'Copiar' },
            { extend: 'print', text: 'Imprimir' },'excel', 'pdf'
        ],
        "ajax": api+tabla,
        "columns": [
            { "data": "id_carrera" },
            { "data": "corto" },
            { "data": "descripcion" },
            { "data": "activa",
            "render": function(data,type,row,meta) {
                if (row.activa == 1) {
                    var etiqueta = '<p class="text-center"><span class="label label-success" >Activa</span></p>';
                } else{
                    etiqueta = '<p class="text-center"><span class="label label-danger">Inactiva</span></p>';
                }
              return etiqueta;
             }

             },
                
            { "defaultContent": "<p class='text-center'><a href='#' class='edit btn btn-info  btn-condensed'><i class='fa fa-pencil'></i></a>  <a href='#' class='elimiar btn btn-danger btn-condensed'><i class='glyphicon glyphicon-remove'></i></a></p>"}

        ]
    } );

   $('#verCarreras').on('click', 'a.elimiar', function(e){
        e.preventDefault();
        var data = tablaCarrera.row($(this).parents('tr')).data();
        var elementoid = data['id_carrera'];

        function datosEliminar(){
            //AJAX 
                            $.ajax({
                                dataType: "json",
                                url: api+tabla+'/'+elementoid,
                                type: 'delete',
                                
                            
                            beforeSend: function () {
                                $("#resultadoCons").html(" <div class='progress'><div class='progress-bar progress-bar-striped active'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>Cargando información.. </div></div>");
                            },

                            error: function(xhr) { // if error occured
                                

                               $("#resultadoCons").html("<div class='alert alert-danger' role='alert'><strong>Ocurrió un error al Eliminar los datos </strong> <br> Intente reiniciando el navegador.</div>");


                            },
                            success: function(data)
                           {
                                //alert(data);

                                $.each(data, function(i,item){
                                    $("#resultadoCons").html(" ");
                                    //alert(data[i].corto);
                                    var res = data[i];
                                   // alert(data[i]);
                                    
                                    //alert(data[i].activa);
                                    if (res == "true") {
                                        //$("#eactiva").prop("checked", true);
                                         $.notify({
                                            title: "<strong>Correcto:</strong> ",
                                            icon: 'glyphicon glyphicon-star',
                                            message: "Se eliminó el registro!.",
                                            animate: {
                                                enter: 'animated fadeInRight',
                                                exit: 'animated fadeOutRight'
                                            }
                                        },{
                                            type: 'success',
                                            element: '#resultadoCons'
                                        });


                                    }else if (res == "false"){
                                        
                                        $.notify({
                                            title: "<strong>Error:</strong> ",
                                            icon: 'glyphicon glyphicon-star',
                                            message: "No se eliminó el registro, posiblemente el registro está en uso.",
                                            animate: {
                                                enter: 'animated fadeInRight',
                                                exit: 'animated fadeOutRight'
                                            }
                                        },{
                                            type: 'danger',
                                            element: '#resultadoCons'
                                        });
                                    }

                                     
                                })

                                tablaCarrera.ajax.reload();
                                
                                // $('#ecorto').val('');    

                                //$("#editarCarrera").html(data); // Mostrar la respuestas del script PHP.

                           }
                       });

                            //AJAX END
        }

        $.confirm({
            title: 'Eleminiar el registro?',
            icon: 'fa fa-warning',
            theme: 'material',
            animation: 'scaleX',
            closeAnimation: 'RotateY',
            confirmButton: 'Eliminar',
            cancelButton: 'Cancelar',
            confirmButtonClass: 'btn-info',
            cancelButtonClass: 'btn-danger',
            content: 'Si el registro está <strong>EN USO</strong> no podra ser eliminado, solo desactivarlo en el catalogo! ',
            confirm: function(){
                //$.alert('Confirmed!'); // shorthand.
                datosEliminar();

            }
        });
   })

    $('#verCarreras').on('click', 'a.edit', function (e) {
        e.preventDefault();
        var data = tablaCarrera.row($(this).parents('tr')).data();
        var buscarid= data['id_carrera'];

        $.ajax({
            dataType: "json",
            url: api+tabla+'/'+buscarid,
            type: 'GET',
            
        
        beforeSend: function () {
            $("#erespuesta").html(" <div class='progress'><div class='progress-bar progress-bar-striped active'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>Cargando información.. </div></div>");
        },

        error: function(xhr) { // if error occured
            

           $("#editarCarrera").html("<div class='alert alert-danger' role='alert'><strong>Ocurrió un error al cargar los datos </strong> <br> Intente reiniciando el navegador.</div>");


        },
        success: function(data)
       {
            //alert(data);

            $.each(data, function(i,item){
                $("#erespuesta").html(" ");
                //alert(data[i].corto);
                $('#eid').val(data[i].id_carrera);
                $('#ecorto').val(data[i].corto);
                $('#edescripcion').val(data[i].descripcion);
                //alert(data[i].activa);
                if (data[i].activa == 1) {
                    $("#eactiva").prop("checked", true);
                }else{
                    $("#eactiva").prop("checked", false);
                }
                 
            })
            
            // $('#ecorto').val('');    

            //$("#editarCarrera").html(data); // Mostrar la respuestas del script PHP.

       }
   });
        


        $('#modalEditar').modal({
              keyboard: false,
              show: true,
              backdrop: 'static'
        })
        //alert(data['corto']+" es la abreviacion de: " + data['descripcion']);
    } );





    function limpiarForm(){
        $('#corto').val('');
        $('#descripcion').val('');

    }

    function muestraError(lugar){
          $.notify({
                        title: "<strong>Error:</strong> ",
                        icon: 'glyphicon glyphicon-star',
                        message: "No se han agregado los registros, intente nuevamente.",
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

   

            var validar = $("#carreras").validate({
                ignore: [],
                rules: {                                            
                        corto: {
                                required: true,
                                minlength: 2,
                                maxlength: 7
                        },
                        descripcion: {
                                required: true,
                                minlength: 3,
                                maxlength: 40
                        }
                },
                messages:{
                    corto: "Debe introducir el nombre corto de la carrera. (Max 7 caracteres)",
                    descripcion: "Debe introducir el nombre de la carrera."
                },
                submitHandler: function(form){
                     var url = api+tabla; // El script a dónde se realizará la petición.
                     var corto = $('#corto').val();
                     var descripcion = $('#descripcion').val();
                     var activa = $('input:radio[name=activa]:checked').val();

                     var parametros = {
                        "corto" : corto,
                        "descripcion" : descripcion,
                        "activa" : activa
                     };
                        $.ajax({
                               data: parametros,
                               type: "POST",
                               url: url,

                               beforeSend: function () {
                                        $("#respuesta").html(" <div class='progress'><div class='progress-bar progress-bar-striped active'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>Guardando.. </div></div>");
                                },

                                error: function(xhr) { // if error occured
                                    


                                   // $("#respuesta").html("Ocurrio un error al guardar los datos, intente de nuevo.");
                                   // $(placeholder).append(xhr.statusText + xhr.responseText);
                                   // $(placeholder).removeClass('loading');
                                    $("#respuesta").html(' ');
                                   muestraError("#respuesta");
                                  


                                },

                               success: function(data)
                               {

                                    $("#respuesta").html(' ');
                                  // $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
                                   // $("#muestraCarreras").load('sw/carreras/carreras.php');
                                   muestraCorrecto("#respuesta");
                                   limpiarForm();
                                   tablaCarrera.ajax.reload();
                                                   
                                  


                               }
                             });

                        return false; // Evitar ejecutar el submit del formulario.
                 


                }

                });   

                //VALIDAR FORMULARIO DE EDITAR

                var jvalidate = $("#editarCarrera").validate({
                ignore: [],
                rules: {                                            
                        ecorto: {
                                required: true,
                                minlength: 2,
                                maxlength: 7
                        },
                        edescripcion: {
                                required: true,
                                minlength: 3,
                                maxlength: 40
                        }
                },
                messages:{
                    ecorto: "Debe introducir el nombre corto de la carrera. (Max 7 caracteres)",
                    edescripcion: "Debe introducir el nombre de la carrera."
                },
                submitHandler: function(form){
                     var id = $('#eid').val();
                     var url = api+tabla+"/"+id; // El script a dónde se realizará la petición.
                     var corto = $('#ecorto').val();
                     var descripcion = $('#edescripcion').val();
                     var activa = $('input:checkbox[name=eactiva]:checked').val();
                     //alert(activa);

                     var parametros = {
                        "corto" : corto,
                        "descripcion" : descripcion,
                        "activa" : activa
                     };
                        $.ajax({
                               data: parametros,
                               type: "PUT",
                               url: url,

                               beforeSend: function () {
                                        $("#erespuesta").html(" <div class='progress'><div class='progress-bar progress-bar-striped active'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>Guardando.. </div></div>");
                                },

                                error: function(xhr) { // if error occured
                                    


                                   // $("#respuesta").html("Ocurrio un error al guardar los datos, intente de nuevo.");
                                   // $(placeholder).append(xhr.statusText + xhr.responseText);
                                   // $(placeholder).removeClass('loading');
                                  $("#erespuesta").html(' ');
                                   muestraError("#erespuesta");
                                    


                                },

                               success: function(data)
                               {

                                    $("#erespuesta").html(' ');
                                  // $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
                                   // $("#muestraCarreras").load('sw/carreras/carreras.php');
                                   muestraCorrecto("#erespuesta");
                                   limpiarForm();
                                   tablaCarrera.ajax.reload();
                                                   
                                  


                               }
                             });

                        return false; // Evitar ejecutar el submit del formulario.
                 


                }

                }); 



                //VALIDAR FORMULARIO DE EDITAR                                 

   



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
                                <p class="page-head-subtitle">Las <strong>Carreras</strong> son las existentes en la institución y que son auditadas.</p>
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
                            <div class="panel panel-primary panel-principal">
                                 <div class="panel-heading">
                                    <div id="resultadoCons" >
                                        
                                    </div>
                                    <h3 class="panel-title"><span class="fa fa-list-ul"></span> Listado</h3>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive " >
                                        <table id="verCarreras"  class='table table-bordered table-hover table-striped'>
                                        <thead>
                                            <tr>
                                                <th width='10%'>ID</th>
                                                <th width='20%'>Abreviación</th>
                                                <th width='40%'>Nombre</th>
                                                <th width='10%'>Estado</th>
                                                <th width='20%'></th>
                                            </tr>
                                        </thead>
                                        
                                        
                                        </table>

                                       
                                    </div>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->
                        <!-- END PAGE CONTENT TABBED -->
                
            </div>     
            
            <div class="col-md-4">
                <form id="carreras" class="form-horizontal" onsubmit="return false;">
                <div class="panel panel-info panel-principal">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-plus-circle"></span> Agregar nueva</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="respuesta">
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Abreviación:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="corto" id="corto"/>
                                                    </div>                                            
                                                    <span class="help-block">Abreviación de la carrera</span>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Nombre:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="descripcion" id="descripcion"/>
                                                    </div>                                            
                                                    <span class="help-block">Nombre largo de la carrera</span>
                                                </div>
                                    </div>
                                     <div class="form-group" hidden="true">
                                                <label class="col-md-3 control-label">Estado:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="form-group" >
                                                        <div class="col-md-6">                                    
                                                            <label class="check "><input type="radio" class="iradio" value="1" id="activa" name="activa" checked="checked"  /> Activo</label>
                                                        </div>
                                                        <div class="col-md-6">                                    
                                                            <label class="check "><input type="radio" class="iradio" value="0" id="activa" name="activa" /> Inactivo</label>
                                                        </div>
                                                       
                                                    </div>                                        
                                                    <span class="help-block">Si la carrera se encuentra inactivo no sera visible en las consultas.</span>
                                                </div>
                                    </div>



                                </div>
                                <div class="panel-footer">
                                     <button onClick="validar.resetForm();" class="btn btn-default" type="reset" >Limpiar</button>                                    
                                    <button id="btn_guardar" class="btn btn-success pull-right" type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>  
            </div>
                 
            <!-- END PAGE CONTENT -->
        </div>
       
        <!-- END PAGE CONTAINER -->




        <!-- MESSAGE DE confirmación-->
        <div class="message-box animated fadeIn" data-sound="alert" id="confirmacion">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-globe"></span> Alert</div>
                    <div class="mb-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at tellus sed mauris mollis pellentesque nec a ligula. Quisque ultricies eleifend lacinia. Nunc luctus quam pretium massa semper tincidunt. Praesent vel mollis eros. Fusce erat arcu, feugiat ac dignissim ac, aliquam sed urna. Maecenas scelerisque molestie justo, ut tempor nunc.</p>                    
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-info btn-lg pull-right mb-control-close">Got it!</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END DE confirmación-->





        <!-- EDITAR CARRERAS -->
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Carreras</h4>
              </div>
              <div class="modal-body" >
              <form id="editarCarrera" class="form-horizontal" onsubmit="return false;">
                    
                                    <div id="erespuesta">
                                        
                                    </div>
                                     <div class="form-group">
                                                
                                                <label class="col-md-3 control-label">ID:</label>
                                                <div class="col-md-9">
                                                                                                
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input readonly hidden="true"  type="text" class="form-control" name="eid" id="eid"/>
                                                    </div>                                            
                                                    <span class="help-block">Id carrera</span>
                                                </div>
                                    </div>
                                    
                                    <div class="form-group">
                                                
                                                <label class="col-md-3 control-label">Abreviación:</label>
                                                <div class="col-md-9">
                                                                                                
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input  type="text" class="form-control" name="ecorto" id="ecorto"/>
                                                    </div>                                            
                                                    <span class="help-block">Abreviación de la carrera</span>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Nombre:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="edescripcion" id="edescripcion"/>
                                                    </div>                                            
                                                    <span class="help-block">Nombre largo de la carrera</span>
                                                </div>
                                    </div>
                                     <div class="form-group" >
                                                <label class="col-md-3 control-label">Estado:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="checkbox">
                                                        <label>
                                                          <input type="checkbox" name="eactiva" id="eactiva" value="1"> Activo
                                                        </label>
                                                      </div>                                        
                                                    <span class="help-block">Si la carrera se encuentra inactivo no sera visible en las consultas.</span>
                                                </div>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                                                         
                                    <button id="btn_editar" class="btn btn-success pull-right" type="submit">Guardar</button>
                                </div>
              
              </form>  
              </div>
              
          </div>
        </div>

        </div>  
        
        


<?php
    include ('commons/footer.php');
    include ('commons/endscripts.php');
    include ('commons/end.php');
?>






