<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Leer el valor ingresado en pulgadas
    $pulgadas = floatval($_POST["pulgadas"]);

    // Convertir a centímetros (1 pulgada = 2.54 cm)
    $centimetros = $pulgadas * 2.54;

    // Imprimir el resultado
    echo "<h1>Resultado de la Conversión</h1>";
    echo "<p>$pulgadas pulgadas es igual a $centimetros centímetros.</p>";
}
?>