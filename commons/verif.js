   var ano = (new Date).getFullYear();
 
            $(document).ready(function() {               
              $(".fecha").html(ano);




//----------------------check-------------------
              $("#enviar").click(function(){

                    
                     var usuario = $('#usuario').val();
                     var pass = $('#pass').val();
                     if (!usuario || !pass) {
                            $.alert({
                                                  title: 'Incorrecto!',
                                                  icon: 'fa fa-frown-o',
                                                  content: 'Faltan datos para poder acceder.',
                                                  confirmButton: 'Ok'
                                                  
                                                  
                                              });
                     } else {
                     //alert(url);
  
                              $.ajax({
                                     type: "post",
                                     data: {'usuario': usuario, 'password': pass},
                                     url: "commons/verif.php",

                                     beforeSend: function () {
                                        $(".loading").html(" <div class='progress'><div class='progress-bar progress-bar-striped active'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>Comprobando acceso, espere porfavor!.. </div></div>");
                                      },

                                      error: function(xhr) { // if error occured
                                          


                                         // $("#respuesta").html("Ocurrio un error al guardar los datos, intente de nuevo.");
                                         // $(placeholder).append(xhr.statusText + xhr.responseText);
                                         // $(placeholder).removeClass('loading');
                                          $(".loading").html(' ');
                                        $.alert({
                                                        title: 'Error!!',
                                                        icon: 'fa fa-frown-o',
                                                        content: 'No podimos comprobar tus datos, por favor verificar que el servidor este encendido.',
                                                        confirmButton: 'Ok'
                                                        
                                                        
                                                    });
                                        


                                      },

                                     success: function(data)
                                     {    




                                          
                                              
                                              $(".loading").html(" ");
                                              var obj = JSON.parse(data);
                                              
                                              var res = obj['STATUS'];
                                             // alert(res);
                                              //alert(data[i].activa);
                                              if (res == "true") {
                                                  //$("#eactiva").prop("checked", true);
                                                    
                                                    window.location = "carreras.php";



                                              }else if (res == "false"){
                                                  
                                                   $.alert({
                                                        title: 'MMmmm!!',
                                                        icon: 'fa fa-frown-o',
                                                        content: 'El usuario o contraseña es incorrecto.',
                                                        confirmButton: 'Ok'
                                                        
                                                        
                                                    });


                                              }
                                              

                                               
                                          
                                        
                                                         
                                        


                                     }
                                   });
                        }

                        return false; // Evitar ejecutar el submit del formulario.
                 


                

                });




//----------------------check-------------------


            });