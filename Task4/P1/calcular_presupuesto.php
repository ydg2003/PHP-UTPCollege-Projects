<?php
// Este archivo PHP calcula el presupuesto dividido por área

// Array de áreas y porcentajes
$areas = [
    "Ginecología" => 40,
    "Traumatología" => 35,
    "Pediatría" => 25
];

// Obtener el presupuesto desde el formulario
if (isset($_POST['presupuesto'])) {
    $presupuesto_total = (float)$_POST['presupuesto'];

    // Verificar si el presupuesto es válido
    if ($presupuesto_total > 0) {
        // Array para almacenar los resultados
        $presupuesto_por_area = [];

        // Calcular el presupuesto por área
        foreach ($areas as $area => $porcentaje) {
            $presupuesto_area = ($presupuesto_total * $porcentaje) / 100;
            $presupuesto_por_area[$area] = $presupuesto_area;
        }

        // Mostrar los resultados
        echo "<h2>Presupuesto dividido por área:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Área</th><th>Presupuesto ($)</th></tr>";

        foreach ($presupuesto_por_area as $area => $presupuesto) {
            echo "<tr><td>$area</td><td>$presupuesto</td></tr>";
        }

        echo "</table>";
    } else {
        echo "Por favor, introduce un presupuesto válido.";
    }
}
?>