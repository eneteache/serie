<?php 
ob_start(); 
header("Content-type: text/javascript"); 

// Creamos la conexion 
include 'funciones/funcionesConectarBD.php';
$con = conectarBD();
//$con = @mysqli_connect('localhost', 'root', '123456', 'proyecto') or die("document.write('Error');");

// Obtenemos, y validamos url 
$url = $_SERVER['HTTP_REFERER']; 
$fechaHoy = date("Y-m-d");
//$fechaHoy = "2017-03-11";
if (!$url || $url == '') { 
    die(); 
} 

// Obtenemos los datos de la bd 
$sql = "SELECT `visitas` FROM `visitas` WHERE `url`='$url' and fecha='$fechaHoy'"; 
$query = mysqli_query($con, $sql); 
$row = mysqli_fetch_assoc($query); 

// creamos las querys verificando primero las cookies, para contar visitas y no impresiones
if (isset($_COOKIE[md5($url)])) { 
    // cuando si existe la cookie solo le damos el valor a $visitas 
    $visitas = $row['visitas']; 
    //echo "document.write($visitas);"; 
} elseif (!isset($_COOKIE[md5($url)])) { 
    // Comprobamos si la url ya esta en la bd 
    $rows = mysqli_num_rows($query); 
    if ($rows > 0) { 
        // Cuando si existe la url actualizamos 
        $SQL = "UPDATE `visitas` SET `visitas`=visitas+1 WHERE `url`='$url'"; 
        if (mysqli_query($con, $SQL)) { // Si se inserta la visita 
            $visitas = ($row['visitas']) + (1); // Le sumamos uno para mostrar la visita actual
            //echo "document.write($visitas);"; 
            setcookie(md5($url), '_vStD', time() + 300); // Y creamos la cookie de 5 minutos
        } else { // Si no se inserta la visita 
            $visitas = $row['visitas']; // Solo obtenemos las visitas 
           // echo "document.write($visitas);"; 
        } 
    } elseif ($rows == 0) { 
        // Cuando no existe la url en la bd la insertamos 
        $SQL = "INSERT INTO `visitas` (fecha,`url`,`visitas`) VALUES ('$fechaHoy','$url',1)"; 
        if (mysqli_query($con,$SQL)) { // Si se inserta la nueva url 
            //echo "document.write(1);"; 
            setcookie(md5($url), '_vStD', time() + 300); // Y creamos la cookie de 5 minutos
        } else { // Si no se inserta  
            //echo "document.write(0);"; 
        } 
    } 
} 