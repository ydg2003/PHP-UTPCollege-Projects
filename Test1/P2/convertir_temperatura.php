<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger el valor ingresado en el formulario
    $fahrenheit = (float)$_POST['fahrenheit'];

    // Fórmula de conversión a Celsius
    $celsius = ($fahrenheit - 32) * (5 / 9);

    // Mostrar el resultado
    echo "<h3>Resultado:</h3>";
    echo "Temperatura en Fahrenheit: " . number_format($fahrenheit, 2) . "°F<br>";
    echo "Temperatura en Celsius: " . number_format($celsius, 2) . "°C<br>";
}
?>