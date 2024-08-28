<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $n = $_POST['n'];
    echo "Los primeros $n múltiplos de 4 son:<br>";
    for ($i = 1; $i <= $n; $i++) {
        echo "4 * $i = " . (4 * $i) . "<br>";
    }
}
?>

<form method="post">
    Introduce un número N: 
    <input type="number" name="n">
    <input type="submit" value="Calcular">
</form>