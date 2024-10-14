<?php 
include("clases/setting.inc.php");
$sql = new mod_db();

//implementamos la clase empleado
class cEmpleado{
 //constructor	
 function cEmpleado(){
 }	
 
 // consulta los empledos de la BD
 function consultar(){
   //creamos el objeto $con a partir de la clase DBManager
   global $sql;
   //usamos el metodo conectar para realizar la conexion
     $consulta = "select * from  empleado  order by nombre";
	 	$ad_query = $sql->query($consulta);
	 
	 if (!$ad_query)
	   return false;
	 else
	   return $result;

 }
 //inserta un nuevo empleado en la base de datos
 function crear($nom,$dep,$suel){
   global $sql;
   
      		$cols= "nombre,departamento,sueldo ";
			$val = "'$nom','$dep','$suel'";
			$sql->insert("empleado",$cols,$val,"");

       	
		if ($sql->insert("empleado",$cols,$val,""))
		return true;
		else return false;
		
}//Fin de la Función crear($nom,$dep,$suel)
}
?>
