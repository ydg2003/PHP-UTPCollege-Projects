<?php
// Definir el arreglo con las notas
$notas = array(95, 96, 85, 60, 75, 100, 61, 80);

// Inicializar variables para la suma de las notas y el número de notas
$suma = 0;
$n = count($notas);

// Calcular la suma de las notas usando una estructura repetitiva (foreach)
foreach ($notas as $nota) {
    $suma += $nota;
}

// Calcular la media
$media = $suma / $n;

// Inicializar variable para la suma de las diferencias al cuadrado
$suma_diferencias = 0;

// Calcular la suma de las diferencias al cuadrado
foreach ($notas as $nota) {
    $suma_diferencias += pow($nota - $media, 2);
}

// Calcular la desviación estándar muestral (n-1 en el denominador)
$desviacion_estandar = sqrt($suma_diferencias / ($n - 1));

// Imprimir la media y la desviación estándar muestral
echo "La media de las notas es: " . $media . "\n";
echo "La desviación estándar muestral de las notas es: " . $desviacion_estandar . "\n";
?>