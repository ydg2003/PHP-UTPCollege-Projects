<?php
$suma_pares = 0;
$suma_impares = 0;

for ($i = 1; $i <= 200; $i++) {
    if ($i % 2 == 0) {
        $suma_pares += $i;
    } else {
        $suma_impares += $i;
    }
}

echo "La suma de los números pares es: $suma_pares<br>";
echo "La suma de los números impares es: $suma_impares";
?>