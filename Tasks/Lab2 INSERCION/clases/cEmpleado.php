<?php 
include("clases/setting.inc.php");
$sql = new mod_db();

// Implementamos la clase empleado
class cEmpleado {
    // Constructor
    function __construct() {
        // Initialization if needed
    }    
    
    // Consulta los empleados de la BD
    function consultar() {
        // Creamos el objeto $con a partir de la clase DBManager
        global $sql;

        // Usamos el método conectar para realizar la conexión
        $consulta = "SELECT * FROM empleados ORDER BY nombres";
        $ad_query = $sql->query($consulta);
        
        // Check if query was successful
        if (!$ad_query) {
            return false;
        } else {
            return $ad_query; // Return the result set
        }
    }

    // Inserta un nuevo empleado en la base de datos
    function crear($nom, $dep, $suel) {
        global $sql;
        
        $cols = "nombres, departamento, sueldo"; // Fixed column name 'nombre' to 'nombres'
        $val = "'$nom', '$dep', '$suel'";
        
        if ($sql->insert("empleados", $cols, $val, "")) { // Changed table name from 'empleado' to 'empleados'
            return true;
        } else {
            return false;
        }
    }
}
?>
