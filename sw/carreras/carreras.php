<?php 
    
 
      
        $url = 'http://localhost/SwAS/app/index.php/carreras';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
        // echo "<table  class='table datatable table-hover table-striped'><thead><tr><th width='10%'>ID</th><th>Abreviación</th><th>Nombre</th><th>Estado</th><th width='20%'>Acciones</th></tr></thead><tbody class='contenido-tabla'>";

        foreach($json as $carreras)
        {
            if ($carreras['activa']==1) {
                $activa = "Activa";
                $label = "success";
            } else {
                $activa = "Inactiva";
                $label = "danger";
            }
            echo '<tr><td> '.$carreras['id_carrera'].'</td>';
            echo      '<td>'.$carreras['corto'].'</td>';
            echo      '<td>'.$carreras['descripcion'].'</td>';
            echo      '<td class="text-center"><span class="label label-'.$label.' label-form">'.$activa.'</span></td>';
            echo      '<td><button class="btn btn-default btn-rounded btn-condensed btn-sm"><span class="fa fa-pencil"></span></button></td></tr>';

        }
        //echo($mostrar);
       // echo "</tbody></table>";
        

   