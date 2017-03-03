<?php
    $pagina = "Items";
    include ('commons/head.php');

?>


<script>


$(document).ready(function() {
    var tabla = "/items";

    //------------------------Cargar selects
    function cargarSelect(){

        $.ajax({
                                dataType: "json",
                                url: api+"/serviciosact",
                                type: 'get',
                                
                            
                            beforeSend: function () {
                                
                            },

                            error: function(xhr) { // if error occured
                                    

                            },
                            success: function(data)
                           {
                                //alert(data);
                                var option =""
                                $.each(data, function(i,item){
                                    
                                    //alert(data[i].corto);
                                    var res = data[i];
                                    //alert(data[i].id_servicio);
                                    option += '<option value="'+data[i].id_servicio+'">'+data[i].serv_descripcion+'</option>';
                                   
                                })
                                //alert(option);
                                $("#consulta").append(option);                                     
                                $("#econsulta").append(option);

                     
                                
                               
                                

                           }
                       });


    }

 
cargarSelect();
    //------------------------Cargar selects end


//-----------Modal editar conf  ---------
    $('#modalNuevo').modal({
              keyboard: false,
              backdrop: 'static',
              show: false
        })
    //-----------Modal editar conf end ---------


//-----------------------------Consultar tabla del catalogo.
   var tablaServicio = $('#verTabla').DataTable( {
        "destroy": true,
        "fixedHeader": true,
        "scrollY": "1000px",
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
            { "data": "id_item" },
            { "data": "serv_descripcion" },
            { "data": "item_descripcion" },
            { "data": "item_activo",
            "render": function(data,type,row,meta) {
                if (row.item_activo == 1) {
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
   $('#verTabla').on('click', 'a.elimiar', function(e){
        e.preventDefault();
        var data = tablaServicio.row($(this).parents('tr')).data();
        var elementoid = data['id_item'];

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

    $('#verTabla').on('click', 'a.edit', function (e) {
        e.preventDefault();
        var data = tablaServicio.row($(this).parents('tr')).data();
        var buscarid= data['id_item'];

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
                $('#eid').val(data[i].id_item);
                $('#econsulta').val(data[i].id_servicio);
                $('#eitem_descripcion').val(data[i].item_descripcion);
                //alert(data[i].activa);
                if (data[i].item_activo == 1) {
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
                        icon: 'fa fa-check-circle',
                        message: "Se guardo correctamete!!.",
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        }
                    },{
                        type: 'success',
                        element: lugar,
                        position: 'fixed',
                        offset: 20,
                        placement: {
                            from: 'top',
                            align: 'left'
                        }
                    });
                  

    }

   
//-----------------------------Guardar Formulario NUEVO ----------------------
            var validar = $("#guardarNuevo").validate({
                ignore: [],
                rules: {                                            
                        consulta: {
                                required: true
                                
                        },
                        item_descripcion: {
                                required: true,
                                minlength: 2
                                
                        }
                },
                messages:{
                    consulta: "Seleccione un servicio asociado a la pregunta a realizar.",
                    item_descripcion: "Debe introducir una pregunta con mínimo 2 caracteres.",                },
                submitHandler: function(form){
                     var url = api+tabla; // El script a dónde se realizará la petición.
                     var descripcion = $('#item_descripcion').val();
                     var consulta = $('#consulta').val();
                     var activa = $('input:radio[name=activa]:checked').val();
                     //alert(url);
                     var parametros = {
                        "item_descripcion" : descripcion,
                        "id_servicio" : consulta,
                        "item_activo" : activa
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
                                   document.getElementById("guardarNuevo").reset();
                                                   
                                  


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
                        econsulta: {
                                required: true
                        },
                        eitem_descripcion: {
                                required: true,
                                minlength: 3
                        }
                },
                messages:{
                    econsulta: "Debe seleccionar un elemento.",
                    eitem_descripcion: "Introduzca una pregunta para con mas de 3 caracteres."
                },
                submitHandler: function(form){
                     var id = $('#eid').val();
                    // var url = urlService+"/"+id; // El script a dónde se realizará la petición.
                     var serv = $('#econsulta').val();
                     var item = $('#eitem_descripcion').val();
                     var activa = $('input:checkbox[name=eactiva]:checked').val();
                     //alert(activa);

                     var parametros = {
                        "id_servicio" : serv,
                        "item_descripcion" : item,
                        "item_activo" : activa
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
                                <p class="page-head-subtitle">Los <strong><?php echo strtoupper($pagina);?></strong> son las preguntas que se presentan por servicio en la auditoria de servicios.</p>
                            </div>
                                        
                        </div>
                        <!-- END PAGE HEAD -->
                
                        <!-- PAGE CONTENT TABBED -->
                        <div class="page-content-wrap">
                        <div class="row">
                            
                        </div>                
                
                    <div class="row">
                        <div class="col-sm-12">
                             <div id="mostrarAlerts" class="col-sm-3"></div>
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-primary panel-principal">
                                 <div class="panel-heading">
                                    <div id="resultadoCons" >
                                        
                                    </div>
                                    <h3 class="panel-title"><span class="fa fa-list-ul"></span> Listado</h3>
                                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modalNuevo"><span class="fa fa-file" aria-hidden="true"></span>
                                      NUEVO
                                    </button>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive " >
                                        <table id="verTabla"  class='table table-bordered table-hover table-striped'>
                                        <thead>
                                            <tr>
                                                <th width='5%'>ID</th>
                                                <th width='10%'>Servicio</th>
                                                <th width='50%'>Item</th>
                                                <th width='10%'>Estado</th>
                                                <th width='25%'></th>
                                            </tr>
                                        </thead>
                                        
                                        
                                        </table>

                                       
                                    </div>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->
                        <!-- END PAGE CONTENT TABBED -->
                
            </div>     
            
            
                 
            <!-- END PAGE CONTENT -->
        </div>
       
        <!-- END PAGE CONTAINER -->

    




        <!-- MODAL NUEVO REGISTRO  -->
        <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nuevo</h4>
              </div>
              <div class="modal-body" >
              
                    
                    <form id="guardarNuevo" class="form-horizontal" onsubmit="return false;">
                
                                    <div id="respuesta">
                                        
                                    </div>
                                    <div class="form-group">
                                            <label class="col-md-3 control-label">Servicio:</label>
                                            <div class="col-md-9">                                                                                
                                                <select id="consulta" name="consulta" class="form-control">
                                                    <option value="">Elige uno...</option>
                                                   
                                                </select>
                                                <span class="help-block">Servicio al que pertenece el Item.</span>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Item:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"></span>
                                                        <textarea rows="8" type="text" class="form-control" name="item_descripcion" id="item_descripcion"/></textarea>
                                                    </div>                                            
                                                    <span class="help-block">Pregunta a realizar en la auditoria.</span>
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
                                                    <span class="help-block">Si se encuentra inactivo no sera visible en las consultas.</span>
                                                </div>
                                    </div>



                            
                                <div class="panel-footer">
                                     <button onClick="validar.resetForm();" class="btn btn-default" type="reset" >Limpiar</button>                                    
                                    <button id="btn_guardar" class="btn btn-success pull-right " type="submit">Guardar</button>
                                </div>
                           
                        </form>  



              </div>
              
          </div>
        </div>

        </div>  

        <!-- MODAL NUEVO REGISTRO END -->



       




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
                                            <label class="col-md-3 control-label">Servicio:</label>
                                            <div class="col-md-9">                                                                                
                                                <select id="econsulta" name="econsulta" class="form-control">
                                                    <option value="">Elige uno...</option>
                                                   
                                                </select>
                                                <span class="help-block">Servicio al que pertenece el Item.</span>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Item:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"></span>
                                                        <textarea rows="8" type="text" class="form-control" name="eitem_descripcion" id="eitem_descripcion"/></textarea>
                                                    </div>                                            
                                                    <span class="help-block">Pregunta a realizar en la auditoria.</span>
                                                </div>
                                    </div>
                                    
                                     <div class="form-group" >
                                                <label class="col-md-3 control-label">Estado:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="form-group" >
                                                        <div class="col-md-12 checkbox">                                    
                                                            <label class="check "><input type="checkbox" value="1" id="eactiva" name="eactiva" /> Activo</label>
                                                        </div>
                                                        
                                                       
                                                    </div>                                        
                                                    <span class="help-block">Si se encuentra inactivo no sera visible en las consultas.</span>
                                                </div>
                                    </div>



                            
                                <div class="panel-footer">
                                     <button onClick="validar.resetForm();" class="btn btn-default" type="reset" >Limpiar</button>                                    
                                    <button id="btn_editar" class="btn btn-success pull-right " type="submit">Guardar</button>
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






