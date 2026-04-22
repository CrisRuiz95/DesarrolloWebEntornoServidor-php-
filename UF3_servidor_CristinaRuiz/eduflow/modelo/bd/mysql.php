<?php
class eduflow {
    private static $conexion = null;
    //Crear conexión en caso de no estar creada
    private static function conexionBD(){
        $config = parse_ini_file(__DIR__ ."/../../config.ini");
        if (self::$conexion === null){
            self::$conexion = new mysqli($config['server'],$config['user'],$config['pasw'],$config['bd']);
        if (self::$conexion->connect_error){
            die("Error en la conexión: " . self::$conexion->connect_error);
        }
        self::$conexion->set_charset('utf8');
        }
        return self::$conexion;
    }
    //Met estatico para insertar datos
    public static function consultaInsercion($consulta){
        $conexion = self::conexionBD();
        if($conexion->query($consulta)) {
            return true;
        } else {
            return false;
        }
    }
    //Met estatico para lectura
    public static function consultaLectura($consulta) {
        $conexion = self::conexionBD();
        $resultado = $conexion->query($consulta);
        //Comprobación de resultados
        if($resultado->num_rows > 0){
            return $resultado->fetch_all(MYSQLI_ASSOC);//$resultado['nombrecampo'] fetch_object()$resultado->'nombredelcampo'
             
        } else {
            return null;
        }

    }


    public static function cerrarConexion() {
        if (self::$conexion !== null){
            self::$conexion->close();
            self::$conexion = null;
        }
    }

}

?>