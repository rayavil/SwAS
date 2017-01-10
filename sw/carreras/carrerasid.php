<?php 
	$id = $_POST['id'];
	$data = file_get_contents("http://localhost/SwAS/app/index.php/carreras/".$id);
	$carreras = json_decode($data, true);

	foreach ($carreras as $carrera) {
	?>
	
              
                                
                                <div class="panel-body">
                                    <div id="erespuesta">
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                    			<input  hidden="true" value="<?php echo $carrera['id_carrera'] ?>" type="text" class="form-control" name="eid" id="eid"/>
                                                <label class="col-md-3 control-label">Abreviación:</label>
                                                <div class="col-md-9">
                                                	                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input value="<?php echo $carrera['corto'] ?>" type="text" class="form-control" name="ecorto" id="ecorto"/>
                                                    </div>                                            
                                                    <span class="help-block">Abreviación de la carrera</span>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Nombre:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input value="<?php echo $carrera['descripcion'] ?>" type="text" class="form-control" name="edescripcion" id="edescripcion"/>
                                                    </div>                                            
                                                    <span class="help-block">Nombre largo de la carrera</span>
                                                </div>
                                    </div>
                                     <div class="form-group" >
                                                <label class="col-md-3 control-label">Estado:</label>
                                                <div class="col-md-9">                                            
                                                    <div class="checkbox">
													    <label>
													      <input type="checkbox" <?php if ($carrera['activa'] == 1){ echo "checked";} ?>> Activo
													    </label>
													  </div>                                        
                                                    <span class="help-block">Si la carrera se encuentra inactivo no sera visible en las consultas.</span>
                                                </div>
                                    </div>



                                </div>
                                <div class="panel-footer">
                                                                         
                                    <button id="btn_editar" class="btn btn-success pull-right" type="submit">Guardar</button>
                                </div>
                           
                        


	<?php
    	
	}




 ?>