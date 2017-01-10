<?php
    $pagina = "Servicios";
    include ('commons/head.php');

?>


<script>


$(document).ready(function() {
    var tabla = "/servicios";


//-----------------------------Consultar tabla del catalogo.
   var tablaServicio = $('#verServicios').DataTable( {
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
            { "data": "id_servicio" },
            { "data": "serv_descripcion" },
            { "data": "serv_area" },
            { "data": "serv_semest",
            "render": function(data,type,row,meta) {
                var semestre = row.serv_semest; 
                     verSemestre = '<span class="badge ">'+semestre+'</span>';

              return verSemestre;
             }

             },
            { "data": "serv_act",
            "render": function(data,type,row,meta) {
                if (row.serv_act == 1) {
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


//-----------------------------Consultar tabla del catalogo.


//-----------------------------Botones Eliminar//
   $('#verServicios').on('click', 'a.elimiar', function(e){
        e.preventDefault();
        var data = tablaServicio.row($(this).parents('tr')).data();
        var elementoid = data['id_servicio'];

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
                                 $("#resultadoCons").html(" ");

                              $.notify({
                                            title: "<strong>Error:</strong> ",
                                            icon: 'glyphicon glyphicon-star',
                                            message: "Ocurrió un error al intentar eliminar los datos, el servidor no responde. <br>Actualice la pagina.",
                                            animate: {
                                                enter: 'animated fadeInRight',
                                                exit: 'animated fadeOutRight'
                                            }
                                        },{
                                            type: 'danger',
                                            element: '#resultadoCons'
                                        });

                                    

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
                                        $.alert({
                                            title: 'Eliminado!',
                                            icon: 'fa fa-check-circle',
                                            content: 'Se eliminó el registro. :)',
                                            confirmButton: 'Ok'
                                            
                                        });


                                    }else if (res == "false"){
                                        
                                         $.alert({
                                            title: 'Error al eliminar el registro!',
                                            icon: 'fa fa-exclamation-triangle',
                                            content: 'No se eliminó el registro, posiblemente el registro está en uso. :(',
                                            confirmButton: 'Ok'
                                            
                                        });
                                    }

                                     
                                })

                                tablaServicio.ajax.reload();
                                
                               
                                

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

//-----------------------------Botones Eliminar FIN//



//-----------------------------Botones Editar//

    $('#verServicios').on('click', 'a.edit', function (e) {
        e.preventDefault();
        var data = tablaServicio.row($(this).parents('tr')).data();
        var buscarid= data['id_servicio'];

        $.ajax({
            dataType: "json",
            url: api+tabla+'/'+buscarid,
            type: 'GET',
            
        
        beforeSend: function () {
            $("#erespuesta").html(" <div class='progress'><div class='progress-bar progress-bar-striped active'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>Cargando información.. </div></div>");
        },

        error: function(xhr) { // if error occured
            

           $("#editarRegistro").html("<div class='alert alert-danger' role='alert'><strong>Ocurrió un error al cargar los datos </strong> <br> Intente reiniciando el navegador.</div>");


        },
        success: function(data)
       {
            //alert(data);

            $.each(data, function(i,item){
                $("#erespuesta").html(" ");
                //alert(data[i].corto);
                $('#eid').val(data[i].id_servicio);
                $('#eserv_descripcion').val(data[i].serv_descripcion);
                $('#earea').val(data[i].serv_area);
                // $('#esemestre').val(data[i].semestre);
                //alert(data[i].serv_semest);
                $('#esemestre > option[value="'+data[i].serv_semest+'"]').attr('selected', 'selected');

                //alert(data[i].activa);
                if (data[i].serv_act == 1) {
                    $("#eactiva").prop("checked", true);
                }else{
                    $("#eactiva").prop("checked", false);
                }
                 
            })
            
            // $('#ecorto').val('');    

           

       }
   });
        


        $('#modalEditar').modal({
              keyboard: false,
              show: true,
              backdrop: 'static'
        })
        //alert(data['corto']+" es la abreviacion de: " + data['descripcion']);
    } );

//-----------------------------Botones Editar FIN//



    function limpiarForm(){
        $('#serv_descripcion').val('');
        $('#serv_area').val('');

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

   
//-----------------------------Guardar Formulario NUEVO ----------------------
            var validar = $("#servicios").validate({
                ignore: [],
                rules: {                                            
                        serv_descripcion: {
                                required: true,
                                minlength: 2,
                                maxlength: 140
                        },
                        serv_area: {
                                required: true,
                                minlength: 2,
                                maxlength: 140
                        },
                        semestre:{
                          required: true
                        }
                },
                messages:{
                    serv_descripcion: "Debe introducir el nombre para el servicio. (Min 2 caracteres)",
                    serv_area: "Debe introducir un area a pertenciente a este servicio..(Min 2, Max. caracteres)",
                    semestre: "Elige el semestre a partir del cual se aplicara este servicio."
                },
                submitHandler: function(form){
                     var url = api+tabla; // El script a dónde se realizará la petición.
                     var descripcion = $('#serv_descripcion').val();
                     var area = $('#serv_area').val();
                     var activa = $('input:radio[name=activa]:checked').val();
                     var semestre = $('#semestre').val();
                     //alert(url);
                     var parametros = {
                        "serv_descripcion" : descripcion,
                        "serv_area" : area,
                        "semestre" : semestre,
                        "serv_act" : activa
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
                                   tablaServicio.ajax.reload();
                                                   
                                  


                               }
                             });

                        return false; // Evitar ejecutar el submit del formulario.
                 


                }

                });   

//-----------------------------Guardar Formulario NUEVO  FIN----------------------            

//-----------------------------Guardar Formulario EDITAR ----------------------

                var jvalidate = $("#editarRegistro").validate({
                ignore: [],
                rules: {                                            
                        eserv_descripcion: {
                                required: true,
                                minlength: 2,
                                maxlength: 150
                        },
                        earea: {
                                required: true,
                                minlength: 3,
                                maxlength: 40
                        },
                        semestre:{
                          required: true
                        }
                },
                messages:{
                    eserv_descripcion: "El servicio debe tener minimo 2 caracteres max. 150",
                    earea: "Debe introducir el nombre de la carrera.",
                    semestre: "Elige el semestre a partir del cual se aplicara este servicio."
                },
                submitHandler: function(form){
                     var id = $('#eid').val();
                    // var url = urlService+"/"+id; // El script a dónde se realizará la petición.
                     var serv = $('#eserv_descripcion').val();
                     var area = $('#earea').val();
                     var semestre = $('#esemestre').val();

                     var activa = $('input:checkbox[name=eactiva]:checked').val();
                     //alert(activa);

                     var parametros = {
                        "serv" : serv,
                        "area" : area,
                        "semestre" : semestre,
                        "serv_act" : activa
                     };
                        $.ajax({
                               data: parametros,
                               type: "PUT",
                               url: api+tabla+"/"+id,

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
                                   tablaServicio.ajax.reload();
                                                   
                                  


                               }
                             });

                        return false; // Evitar ejecutar el submit del formulario.
                 


                }

                }); 

//-----------------------------Validar Formulario EDITAR FIN--------------                             



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
                                <p class="page-head-subtitle">Los <strong><?php echo strtoupper($pagina);?></strong> son los existentes en la institución y que son auditados.</p>
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
                                        <table id="verServicios"  class='table table-bordered table-hover table-striped'>
                                        <thead>
                                            <tr>
                                                <th width='5%'>ID</th>
                                                <th width='30%'>Servicio</th>
                                                <th width='20%'>Area</th>
                                                <th width='10%'>Semestre</th>
                                                <th width='10%'>Estado</th>
                                                <th width='35%'></th>
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
                <form id="servicios" class="form-horizontal" onsubmit="return false;">
                <div class="panel panel-info panel-principal">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-plus-circle"></span> Agregar <?php echo $pagina;?></h3>
                                </div>
                                <div class="panel-body">
                                    <div id="respuesta">
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Nombre:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="serv_descripcion" id="serv_descripcion"/>
                                                    </div>                                            
                                                    <span class="help-block">Nombre del servicio a auditar</span>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Área:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="serv_area" id="serv_area"/>
                                                    </div>                                            
                                                    <span class="help-block">Área a la que pertenece el Servicio</span>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Semestre:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <select name="semestre" id="semestre" class="form-control">
                                                          <option value="">Elige uno...</option>
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                          <option value="5">5</option>
                                                          <option value="6">6</option>
                                                          <option value="7">7</option>
                                                          <option value="8">8</option>
                                                          <option value="9">9</option>
                                                          <option value="10">10</option>
                                                          <option value="11">11</option>
                                                          <option value="12">12</option>
                                                          <option value="13">13</option>
                                                          
                                                        </select>
                                                    </div>                                            
                                                    <span class="help-block">Aplicar este servicio a partir de este semestre.</span>
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
                                    <button id="btn_guardar" class="btn btn-success pull-right " type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>  
            </div>
                 
            <!-- END PAGE CONTENT -->
        </div>
       
        <!-- END PAGE CONTAINER -->




       




        <!-- EDITAR CARRERAS -->
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edición</h4>
              </div>
              <div class="modal-body" >
              <form id="editarRegistro" class="form-horizontal" onsubmit="return false;">
                    
                                    <div id="erespuesta">
                                        
                                    </div>
                                     <div class="form-group">
                                                
                                                <label class="col-md-3 control-label">ID:</label>
                                                <div class="col-md-9">
                                                                                                
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input readonly hidden="true"  type="text" class="form-control" name="eid" id="eid"/>
                                                    </div>                                            
                                                    
                                                </div>
                                    </div>
                                    
                                    <div class="form-group">
                                                
                                                <label class="col-md-3 control-label">Nombre del Servicio:</label>
                                                <div class="col-md-9">
                                                                                                
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input  type="text" class="form-control" name="eserv_descripcion" id="eserv_descripcion"/>
                                                    </div>                                            
                                                    <span class="help-block">Nombre del servicio</span>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Área:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="earea" id="earea"/>
                                                    </div>                                            
                                                    <span class="help-block">Área a la que pertenece el servicio.</span>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Semestre:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <select name="esemestre" id="esemestre" class="form-control">
                                                          <option value="">Elige uno...</option>
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                          <option value="5">5</option>
                                                          <option value="6">6</option>
                                                          <option value="7">7</option>
                                                          <option value="8">8</option>
                                                          <option value="9">9</option>
                                                          <option value="10">10</option>
                                                          <option value="11">11</option>
                                                          <option value="12">12</option>
                                                          <option value="13">13</option>
                                                          
                                                        </select>
                                                    </div>                                            
                                                    <span class="help-block">Aplicar este servicio a partir de este semestre.</span>
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
                                                    <span class="help-block">Si se encuentra inactivo no sera visible en las consultas.</span>
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






