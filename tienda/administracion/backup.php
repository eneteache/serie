<?php
session_start();
class Backup{
    private $usuario;
    private $pass;
    private $database;
    private $servidor;
    private $nombre_archivo;
    private $ruta_carpeta;
 
    public function __construct($db = 'proyecto' , $directorio = 'backups', $usuario = 'root', $pass = '123456', $servidor = 'localhost') {
        $this->usuario = $usuario;
        $this->pass = $pass;
        $this->database = $db;
        $this->servidor = $servidor;
 
        // configurar las rutas a las carpetas
        $this->ruta_carpeta = $this->formatearRuta($directorio);
 
    }
 
    public function getNombre(){
        return $this->nombre_archivo;
    }
 
    public function getRutaCarpeta(){
        return $this->ruta_carpeta;
    }
 
    public function generateBackupSQL($nombre, $table = false){
        // escapamos espacios al nombre del backup
        $nombre = $this->limpiarNombre($nombre);
        $this->nombre_archivo = $nombre.'.sql';
        // ver q sistema operativo tenemos
 
 
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
            //Si es Windows
            $this->generateWindows($nombre, $table);
        }else{
            $this->generateLinux($nombre, $table);
        }
        return true;
 
    }
 
    public function generateBackupZip($nombre, $table = false){
        // escapamos espacios al nombre del backup
        $this->generateBackupSQL($nombre, $table);
        $this->comprimirZip(substr($this->nombre_archivo,0, -4));
        unlink($this->ruta_carpeta.$this->nombre_archivo);
        $this->nombre_archivo = substr($this->nombre_archivo,0, -4).'.zip';
 
        return true;        
    }
 
    // genera el backup para Windows
    private function generateWindows($nombre, $table = false){
        // agregamos la consulta y el usuario
        $cmd = $this->ruta_carpeta."mysqldump.exe -u $this->usuario ";
        // si existe contraseña la agregamos
        if($this->pass != '') 
            $cmd .= "-p$this->pass ";
        // si existe servidor distinto al local
        if($this->servidor != 'localhost' and $this->servidor != '127.0.0.1' and $this->servidor != '')
            $cmd .= "-h $this->servidor ";        
        // seleccionamos la base de datos
        $cmd .= " $this->database ";
        // si existe una tabla 
        if($table)
            $cmd .= " $table ";
        //definimos el nombre para el backup
        $cmd .= " > $this->ruta_carpeta$nombre.sql ";
 
        shell_exec($cmd);
    }
 
    // genera el backup para Linux
    private function generateLinux($nombre, $table = false){
        // agregamos la consulta y el usuario
        $cmd = "mysqldump -u $this->usuario ";
        // si existe contraseña la agregamos
        if($this->pass != '') 
            $cmd .= "-p$this->pass ";
        // si existe servidor distinto al local
        if($this->servidor != 'localhost' and $this->servidor != '127.0.0.1' and $this->servidor != '')
            $cmd .= "-h $this->servidor ";        
        // seleccionamos la base de datos
        $cmd .= " $this->database ";
        // si existe una tabla 
        if($table)
            $cmd .= " $table ";
        //definimos el nombre para el backup
        $cmd .= " > $this->ruta_carpeta$nombre.sql ";
 
        shell_exec($cmd);
    }
 
    public function restaurarBackup($nombre){
        $this->nombre_archivo = $nombre;
        // verifica si el archivo esta compreso
        switch (substr($nombre, -4)) {
        case '.zip':
            $this->descomprimirZip($nombre);
            $nombre = substr($nombre, 0, -4).'.sql';
            break;
        case '.rar':
            /// descomprimir rar
            break;
        }
 
 
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
            //Si es Windows
            $this->restaurarWindows($nombre);
        }else{
            // si es linux u otro SO
            $this->restaurarLinux($nombre);
        }
        return true;
    }
 
    private function restaurarWindows($nombre){
 
        // establese el nombre de usuario
        $cmd = $this->ruta_carpeta."mysql.exe -u $this->usuario ";
        // si existe contraseña la agregamos
        if($this->pass != '') 
            $cmd .= "-p$this->pass ";
        // si existe servidor distinto al local
        if($this->servidor != 'localhost' and $this->servidor != '127.0.0.1' and $this->servidor != '')
            $cmd .= "-h $this->servidor ";
        // seleccionamos la base de datos y la ruta del archivo a restaurar
        $cmd .= " $this->database < $this->ruta_carpeta$nombre";
 
        // ejecuta el comando
        shell_exec($cmd);
        // si el archivo q se llamo a restaurar es un archivo compreso elimina el .sql q fue descompreso
        if(substr($this->nombre_archivo, -4) != '.sql')
            unlink($this->ruta_carpeta.$nombre);
 
        return true;
    }
 
    private function restaurarLinux($nombre){
 
        // establese el nombre de usuario
        $cmd = "mysql -u $this->usuario ";
        // si existe contraseña la agregamos
        if($this->pass != '') 
            $cmd .= "-p$this->pass ";
        // si existe servidor distinto al local
        if($this->servidor != 'localhost' and $this->servidor != '127.0.0.1' and $this->servidor != '')
            $cmd .= "-h $this->servidor ";
        // seleccionamos la base de datos y la ruta del archivo a restaurar
        $cmd .= " $this->database < $this->ruta_carpeta$nombre";
 
        // ejecuta el comando
        shell_exec($cmd);
        // si el archivo q se llamo a restaurar es un archivo compreso elimina el .sql q fue descompreso
        if(substr($this->nombre_archivo, -4) != '.sql')
            unlink($this->ruta_carpeta.$nombre);
 
        return true;
    }
 
    private function descomprimirZip($nombre){
        $zip = new ZipArchive();
        if($zip->open($this->ruta_carpeta.'/'.$nombre) === true){
            $zip->extractTo($this->ruta_carpeta.'/');
            $zip->close();
            return true;
        }
 
        return false;
    }
 
    private function comprimirZip($nombre){
        $zip = new ZipArchive();
        $filename = $this->ruta_carpeta.'/'.$nombre.'.zip';
 
        if($zip->open($filename, ZipArchive::CREATE) === true){
            $zip->addFile($this->ruta_carpeta."/".$nombre.'.sql', $nombre.'.sql' );
            $zip->close();
            return true;
        }else{
            return false;
        }
    }
 
    public function limpiarNombre($nombre){
        $nombre = trim($nombre);
        return preg_replace("/[^a-z0-9]+/i", "-", $nombre);
    }
 
    private function formatearRuta($ruta){
        /**
         * Reemplaza los separadores de directorio incorrectos por los correctos segun el sistema operativo
         * por lo que es lo mismo poner:
         * 
         * carpeta1/carpeta2/carpeta3
         * o
         * carpeta1\carpeta2\carpeta3
         * o
         * carpeta1/carpeta2\carpeta3
         */
 
 
        $ruta = trim($ruta, '\\/');
        $ruta = str_replace('\\',DIRECTORY_SEPARATOR, $ruta);
        $ruta = str_replace('/',DIRECTORY_SEPARATOR, $ruta).DIRECTORY_SEPARATOR;
        //return getcwd().DIRECTORY_SEPARATOR.$ruta;  //retorna ruta absoluta
        return $ruta;
    }
}
date_default_timezone_set('Europe/Madrid');
$copia = new Backup();
$fecha = "backup" . date(date("d-m-Y-H-i-s"));

$copia->generateBackupSQL($fecha);

$_SESSION['log'] = "La copia de seguridad se ha creado con el siguiente nombre <b>" . $copia->getNombre() . "</b>, en el directorio ../administracion/backups ";
echo $_SESSION['log'];
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>