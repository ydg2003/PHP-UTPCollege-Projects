<?php
include_once("clases/cEmpleado.php");

//creamos el objeto $objempleados de la clase cEmpleado
$objempleados=new cEmpleado;

//la variable $lista consulta todos los empleados
$lista= $objempleados->consultar();

?>
<table style="border:1px solid #FF0000; color:#000099;width:400px;">
<tr style="background:#99CCCC;">
<td>Nombres</td>
<td>Departamento</td>
<td>Sueldo</td>
</tr>
<?php
while($ad = $sql->objects('',$lista)){

  echo "<tr>";
  echo "<td>".$ad->nombre."</td>";
  echo "<td>".$ad->departamento."</td>";
  echo "<td>".$ad->sueldo."</td>";
  echo "</tr>";

}//fin del mientras


?>
</table>