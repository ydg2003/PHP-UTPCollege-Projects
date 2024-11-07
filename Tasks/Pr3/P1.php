<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numeros = $_POST['numeros'];
    $numeros_array = explode(',', $numeros);
    $suma = 0;
    foreach ($numeros_array as $numero) {
        $suma += $numero;
    }
    $media = $suma / count($numeros_array);
    echo "La media de los números es: $media";
}
?>

<form method="post">
    Introduce 5 números positivos separados por comas: 
    <input type="text" name="numeros">
    <input type="submit" value="Calcular">
</form>