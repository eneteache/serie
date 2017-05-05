<form action="" method="POST" enctype="multipart/form-data" class="form-vert" id="crearProducto">
        <div class='form-group'>
          <label for="foto">Inserte una foto para el producto</label>
          <input type="file" name="fotoProducto" id="foto">
        </div>
        
        <input type="submit">
    </form>
<?php
  print_r($_POST);
    $uploadsDir = "../imagenes";
    $nombreFoto = basename($_FILES["fotoProducto"]["name"]);
    $tmp_name = $_FILES["fotoProducto"]["tmp_name"];
    $rutaAlmacenamiento = "$uploadsDir/$nombreFoto";
    //move_uploaded_file($_FILES["fotoProducto"]["tmp_name"], "$uploadsDir/$nombreFoto" . $_FILES["fotoProducto"]["name"]);
    
    move_uploaded_file($tmp_name, "$uploadsDir/$nombreFoto");
    //echo "Ruta de almacenamiento del fichero: $uploadsDir/$nombreFoto";
    echo "</br>";
    //echo $rutaAlmacenamiento;
    echo("<br><br><br>");
    echo $nombreFoto
    if ($nombreFoto == "") {
      echo "no hay foto";
    }
    else {
      echo "si hay foto";
    }
?>