<?php
include_once("clases/cEmpleado.php");

// Creamos el objeto $objempleados de la clase cEmpleado
$objempleados = new cEmpleado();

// La variable $lista consulta todos los empleados
$lista = $objempleados->consultar();

// Check if the query returned any results
if ($lista) {
    echo '<table style="border:1px solid #FF0000; color:#000099;width:400px;">';
    echo '<tr style="background:#99CCCC;">
            <td>Nombres</td>
            <td>Departamento</td>
            <td>Sueldo</td>
          </tr>';
    
    // Fetch each row as an object using fetch()
    while ($ad = $lista->fetch(PDO::FETCH_OBJ)) { // Use PDO::FETCH_OBJ to fetch as object
        echo "<tr>";
        echo "<td>" . htmlspecialchars($ad->nombres) . "</td>"; // Corrected to 'nombres'
        echo "<td>" . htmlspecialchars($ad->departamento) . "</td>";
        echo "<td>" . htmlspecialchars($ad->sueldo) . "</td>";
        echo "</tr>";
    }
    echo '</table>';
} else {
    echo "No employees found.";
}
?>
