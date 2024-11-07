<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $radio = $_POST['radio'];

    if ($radio > 0) {
        // Constante de Pi
        $pi = 3.14159265359;

        // Cálculo del área
        $area = $pi * pow($radio, 2);

        // Cálculo del perímetro
        $perimetro = 2 * $pi * $radio;

        echo "<h2>Resultados:</h2>";
        echo "Radio: " . $radio . "<br>";
        echo "Área del círculo: " . number_format($area, 2) . " unidades cuadradas<br>";
        echo "Perímetro del círculo: " . number_format($perimetro, 2) . " unidades<br>";
    } else {
        echo "Por favor, ingresa un valor de radio válido.";
    }
} else {
    echo "Método no permitido.";
}
?>