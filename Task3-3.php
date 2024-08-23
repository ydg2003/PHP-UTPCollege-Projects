<?php
/*
Pseudocode
Deducir el numero de dias de un mes en funcion del numero de orden dentro del calendario (1 enero, 2 febrero, etc.) y teniendo en cuenta si el año es bisiesto o no.
Analisis
1: Enero, 31.
2: Febrero, 31 segun sea el año bisiesto o no.
3: Marzo, 31.
...
12: Diciembre, 31

Pseudocodigo
Algoritmo Bisiesto
inicio
	segun-sea mes hacer
	1, 3, 5, 7, 8, 10, 12;
	dia = 31
	4, 6, 9, 11;
	dia = 30
	si año mod 4 - 0
		entonces dia = 29
		sino dia = 28
	fin-si
	sino
		escribir("Rango del mes", 1 - 12)
	fin-segun
fin
*/
function deducirDiasDelMes($mes, $año) {
    if ($mes < 1 || $mes > 12) {
        return "Error: El mes debe estar en el rango de 1 a 12.";
    }
    switch ($mes) {
        case 1: case 3: case 5: case 7: case 8: case 10: case 12:
            $dias = 31;
            break;
        case 4: case 6: case 9: case 11:
            $dias = 30;
            break;
        case 2:
            if ($año % 4 == 0 && ($año % 100 != 0 || $año % 400 == 0)) {
                $dias = 29;
            } else {
                $dias = 28;
            }
            break;
    }
    return "El mes $mes del año $año tiene $dias días.";
}
// Ejemplo de uso:
$mes = 2;
$año = 2024;
echo deducirDiasDelMes($mes, $año);
?>