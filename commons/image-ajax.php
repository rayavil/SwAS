<?php
//echo $_FILES["file"];
if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    //$nombre = $file["name"];
    $nombre = "logotipo";
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../img/";

    function error($mensaje){
        echo "<script>alert('".$mensaje."');</script>";
    }
    
    if ($tipo != 'image/png' )
    {
      error("Error, el archivo no es una imagen debe ser formato PNG");  
      
      header('Location: ../config.php');
    }
    else if ($size > 2024*2024)
    {
        error("Error, el tamaño máximo permitido es un 2MB");
      
      header('Location: ../config.php');
    }
    else if ($width > 1200 || $height > 1200)
    {
        error("Error la anchura y la altura maxima permitida es 1200px");
        
        header('Location: ../config.php');
    }
    else if($width < 60 || $height < 60)
    {
        error("Error la anchura y la altura mínima permitida es 60px");
        header('Location: ../config.php');
    }
    else
    {
        $src = $carpeta.$nombre.".png";
        move_uploaded_file($ruta_provisional, $src);
        header('Location: ../config.php');
        echo "<img src='$src'>";
    }

}
?>
