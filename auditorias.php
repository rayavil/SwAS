<?php
    $pagina = "Auditorias";
    include ('commons/head.php');
?>

<script>


$(document).ready(function() {
    var tabla = "/auditorias";

    //------------------------Cargar datos principales
    function cargarCiclo(){

        var fullDate = new Date()
        //console.log(fullDate);
        //Thu May 19 2011 17:25:38 GMT+1000 {}
         
        //convert month to 2 digits
        var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
         
        if (twoDigitMonth >= 1 && twoDigitMonth <= 7) {
            $("#ciclo").val("Enero - Junio");   
        } if (twoDigitMonth >= 8 && twoDigitMonth <= 12) {
            $("#ciclo").val("Agosto - Diciembre");   
        }
        $("#anio").val(fullDate.getFullYear());

        var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear();
        console.log(currentDate);
        //19/05/2011

    }

 
cargarCiclo();
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
            { "data": "no_auditoria" },
            { "data": "aud_anio" },
            { "data": "aud_ciclo"},
            { "data": "audi_descripcion" },
            { "data": "actual",
            "render": function(data,type,row,meta) {
                if (row.actual == 1) {
                    var etiqueta = '<p class="text-center"><span class="label label-info" >Auditando</span></p>';
                } else if (row.actual == 0){
                    etiqueta = '<p class="text-center"><span class="label label-default">Inactivo</span></p>';
                } else if (row.actual == 2){
                    etiqueta = '<p class="text-center"><span class="label label-success">Finalizado</span></p>';
                }
              return etiqueta;
             }

             },
                
            { "defaultContent": "<p class='text-center'><a href='#' title ='Ver información completa.' class='view btn btn-info  btn-condensed btn-rounded'><i class='fa fa-eye'></i></a> <a href='#' title='Editar' class='edit btn btn-primary  btn-condensed btn-rounded'><i class='fa fa-pencil'></i></a>  <a href='#' title='Eliminar' class='elimiar btn btn-danger btn-condensed btn-rounded'><i class='glyphicon glyphicon-remove'></i></a></p>"}

        ]
    } );


//-----------------------------Consultar tabla del catalogo.


//-----------------------------Botones Eliminar//
   $('#verTabla').on('click', 'a.elimiar', function(e){
        e.preventDefault();
        var data = tablaServicio.row($(this).parents('tr')).data();
        var elementoid = data['no_auditoria'];

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
                                            content: 'No se eliminó el registro, <strong>no se puede eliminar una auditoria que esta en curso :( </strong>',
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
            content: 'Si el registro está <strong>EN USO</strong> no podra ser eliminado, hasta terminar su uso... ',
            confirm: function(){
                //$.alert('Confirmed!'); // shorthand.
                datosEliminar();

            }
        });
   })

//-----------------------------Botones Eliminar FIN//


//-----------------------------Botones Editar//

$('#eestado').change(function() {
    var valor = $('#eestado').prop('checked');
    //alert('Una vez guardado este valor no podra ser cambiado.');
    if (!valor) {
        $(".valorEstado").html('<span class="label label-default label-form">Inactivo</span>');

    }else {
        $(".valorEstado").html('<span class="label label-info label-form">Auditando</span>');

    }
        
});


    $('#verTabla').on('click', 'a.edit', function (e) {
        e.preventDefault();
        var data = tablaServicio.row($(this).parents('tr')).data();
        var buscarid= data['no_auditoria'];

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
                $('#enoauditoria').val(data[i].no_auditoria);
                $('#eanio').val(data[i].aud_anio);
                $('#eciclo').val(data[i].aud_ciclo);
                $('#edescripcion').val(data[i].audi_descripcion);
                $('#eobservacion').val(data[i].audi_obs);
                //alert(data[i].activa);
                if (data[i].actual == 1) {
                    $("#eestado").prop("checked", true);
                    $(".valorEstado").html('<span class="label label-info label-form">Auditando</span>');
                }else if (data[i].actual == 0){
                    $("#eestado").prop("checked", false);
                    $(".valorEstado").html('<span class="label label-default label-form">Inactivo</span>');
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


//-----------------------------Botones Ver//


    $('#verTabla').on('click', 'a.view', function (e) {
        e.preventDefault();
        var data = tablaServicio.row($(this).parents('tr')).data();
        var buscarid= data['no_auditoria'];
        var anio= data['aud_anio'];
        var ciclo= data['aud_ciclo'];

        var url = 'ver_auditorias.php';
        var form = $('<form action="' + url + '" method="post">' +
          '<input type="text" name="auditorianum" value="' + buscarid + '" />' +
          '<input type="text" name="anio" value="' + anio + '" />' +
          '<input type="text" name="ciclo" value="' + ciclo + '" />' +
          '<input type="text" name="api" value="' + api + '" />' +
          '</form>');
        $('body').append(form);
        form.submit();
        
    } );

//-----------------------------Botones ver FIN//



    function limpiarForm(){
        $('#serv_descripcion').val('');
        $('#serv_area').val('');

    }

    function muestraError(lugar){
          $.notify({
                        title: "<strong>Error:</strong> ",
                        icon: 'glyphicon glyphicon-star',
                        message: "No pueden estar en curso mas de una auditoria, verifique que no se encuentre otra activa, si es asi desactive.",
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
                     var anio = $('#anio').val();
                     var ciclo = $('#ciclo').val();
                     var descripcion = $('#descripcion').val();
                     var observacion = $('#observacion').val();
                     var estado = $('input:radio[name=estado]:checked').val();
                     //alert(url);
                     var parametros = {
                        "anio" : anio,
                        "ciclo" : ciclo,
                        "descripcion" : descripcion,
                        "observacion" : observacion,
                        "estado" : estado
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
                                   alert("Ay un problema con la respuesta del servidor, contacte al administrador del sistema.");
                                  


                                },

                               success: function(data)
                               {    
                                    

                                    $("#respuesta").html(' ');

                                    var resultado = JSON.parse(data);

                                    if (resultado == "true") {
        // $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
                                           // $("#muestraCarreras").load('sw/carreras/carreras.php');
                                           muestraCorrecto("#respuesta");
                                    }else if (resultado == "false") {
                                           muestraError("#respuesta");
                                    }





                                   
                                  
                                   //limpiarForm();
                                   tablaServicio.ajax.reload();
                                   $("#descripcion").val("");
                                   $("#observacion").val("");
                                                   
                                  


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
                        edescripcion: {
                                required: true
                        }
                },
                messages:{
                    edescripcion: "No puede dejar este campo vacio."
                    
                },
                submitHandler: function(form){
                     var noauditoria = $('#enoauditoria').val();
                    // var url = urlService+"/"+id; // El script a dónde se realizará la petición.
                     var descripcion = $('#edescripcion').val();
                     var observacion = $('#eobservacion').val();
                     var estado = $('input:checkbox[name=eestado]:checked').val();
                     //alert(activa);

                     var parametros = {
                        "noauditoria" : noauditoria,
                        "descripcion" : descripcion,
                        "observacion" : observacion,
                        "estado" : estado
                     };
                        $.ajax({
                               data: parametros,
                               type: "PUT",
                               url: api+tabla+"/"+noauditoria,

                               beforeSend: function () {
                                        $("#erespuesta").html(" <div class='progress'><div class='progress-bar progress-bar-striped active'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>Guardando.. </div></div>");
                                },

                                error: function(xhr) { // if error occured
                                    


                                   // $("#respuesta").html("Ocurrio un error al guardar los datos, intente de nuevo.");
                                   // $(placeholder).append(xhr.statusText + xhr.responseText);
                                   // $(placeholder).removeClass('loading');
                                  $("#erespuesta").html(' ');
                                   alert("Hay un problema al conectar al servidor, si el problema persiste, contacte al servidor.");
                                    


                                },

                               success: function(data)
                               {
                                    var result = JSON.parse(data);
                                    
                                    //alert(result);
                                    $("#erespuesta").html(' ');

                                    if (result == 'true') {
                                        muestraCorrecto("#erespuesta");

                                  } else if (result == 'false') {
                                      muestraError("#erespuesta")
                                }

                                    
                                  // $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
                                   // $("#muestraCarreras").load('sw/carreras/carreras.php');
                                   
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
                                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modalNuevo"><span class="fa fa-plus-circle" aria-hidden="true"></span>
                                      NUEVA
                                    </button>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive " >
                                        <table id="verTabla"  class='table table-bordered table-hover table-striped'>
                                        <thead>
                                            <tr>
                                                <th width='5%'>ID</th>
                                                <th width='10%'>Año</th>
                                                <th width='20%'>Ciclo</th>
                                                <th width='30%'>Descripcion</th>
                                                <th width='10%'>Estado</th>
                                                <th width='25%'>Acciones</th>
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
                <h4 class="modal-title" id="myModalLabel">Nueva</h4>
              </div>
              <div class="modal-body" >
              
                    
                    <form id="guardarNuevo" class="form-horizontal" onsubmit="return false;">
                
                                    <div id="respuesta">
                                        
                                    </div>
                                   
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Año:</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="anio" id="anio" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Ciclo:</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" name="ciclo" class="form-control" id="ciclo" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                    <div class="form-group">
                                                <label class="col-sm-2 control-label">Descripción:</label>
                                                <div class="col-sm-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"></span>
                                                        <input type="text" class="form-control" name="descripcion" id="descripcion"/>
                                                    </div>                                            
                                                    <span class="help-block">Información sobre esta auditoria.</span>
                                                </div>
                                    </div>
                                    

                                     <div class="form-group">
                                                <label class="col-sm-2 control-label">Observaciones:</label>
                                                <div class="col-sm-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"></span>
                                                        <input type="text" class="form-control" name="observacion" id="observacion"/>
                                                    </div>                                            
                                                    <span class="help-block">Alguna observacion  adicional (opcional).</span>
                                                </div>
                                    </div>

                                     <div class="form-group" hidden="true">
                                                <label class="col-md-3 control-label">Estado:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="form-group" >
                                                        <div class="col-md-6">                                    
                                                            <label class="check "><input type="radio" class="iradio" value="0" id="estado" name="estado" checked="checked"  /> Activo</label>
                                                        </div>
                                                        <div class="col-md-6">                                    
                                                            <label class="check "><input type="radio" class="iradio" value="0" id="estado" name="estado" /> Inactivo</label>
                                                        </div>
                                                       
                                                    </div>                                        
                                                    <span class="help-block">Si se encuentra inactivo no sera visible en las consultas.</span>
                                                </div>
                                    </div>



                            
                                
                                                                       
                                    <button id="btn_guardar" class="btn btn-success pull-right " type="submit">Guardar</button>
                               
                           
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
                                                
                                                <label class="col-md-2 control-label">ID:</label>
                                                <div class="col-md-">
                                                                                                
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input readonly   type="text" class="form-control" name="enoauditoria" id="enoauditoria"/>
                                                    </div>                                            
                                                    
                                                </div>
                                    </div>
                                    
                                    <div class="row form-group">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Año:</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="eanio" id="eanio" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Ciclo:</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" name="eciclo" class="form-control" id="eciclo" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                    <div class="form-group">
                                                <label class="col-sm-2 control-label">Descripción:</label>
                                                <div class="col-sm-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"></span>
                                                        <input type="text" class="form-control" name="edescripcion" id="edescripcion"/>
                                                    </div>                                            
                                                    <span class="help-block">Información sobre esta auditoria.</span>
                                                </div>
                                    </div>
                                    

                                     <div class="form-group">
                                                <label class="col-sm-2 control-label">Observaciones:</label>
                                                <div class="col-sm-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"></span>
                                                        <input type="text" class="form-control" name="eobservacion" id="eobservacion"/>
                                                    </div>                                            
                                                    <span class="help-block">Alguna observacion  adicional (opcional).</span>
                                                </div>
                                    </div>
                                    
                                     <div class="form-group" >
                                                <label class="col-sm-2 control-label">Estado:</label>
                                                <div class="col-sm-10">                                            
                                                    <div class="form-group" >
                                                        <div class="col-sm-2 ">                                    
                                                             <label class="switch">
                                                                <input id="eestado" name="eestado" type="checkbox" value="1"/>
                                                                <span > </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                          <span class="valorEstado"></span>  
                                                        
                                                        </div>
                                                       
                                                        
                                                    </div>                                        
                                                    
                                                </div>
                                    </div>

                                    <button id="btn_editar" class="btn btn-success pull-right " type="submit">Guardar</button>             
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






