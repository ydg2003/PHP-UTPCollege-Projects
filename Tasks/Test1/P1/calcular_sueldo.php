<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $horas = (float)$_POST['horas'];
    $tarifa = (float)$_POST['tarifa'];

    // Calcular salario bruto
    if ($horas <= 35) {
        $salarioBruto = $horas * $tarifa;
    } else {
        $salarioBruto = 35 * $tarifa + ($horas - 35) * 1.5 * $tarifa;
    }

    // Calcular impuesto
    if ($salarioBruto <= 2000) {
        $impuesto = 0;
    } elseif ($salarioBruto > 2000 && $salarioBruto <= 2500) {
        $impuesto = $salarioBruto * 0.2;
    } else {
        $impuesto = $salarioBruto * 0.3;
    }

    // Calcular sueldo neto
    $sueldoNeto = $salarioBruto - $impuesto;

    // Mostrar resultados
    echo "<h3>Resultados:</h3>";
    echo "Nombre del empleado: " . htmlspecialchars($nombre) . "<br>";
    echo "Salario Bruto: $" . number_format($salarioBruto, 2) . "<br>";
    echo "Impuesto: $" . number_format($impuesto, 2) . "<br>";
    echo "Sueldo Neto: $" . number_format($sueldoNeto, 2) . "<br>";
}
?>