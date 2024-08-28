<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $char1 = $_POST['char1'];
    $char2 = $_POST['char2'];

    if ($char1 < $char2) {
        echo "Los caracteres están en orden alfabético.";
    } else {
        echo "Los caracteres no están en orden alfabético.";
    }
}
?>

<form method="post">
    Introduce el primer carácter: 
    <input type="text" name="char1" maxlength="1">
    <br>
    Introduce el segundo carácter: 
    <input type="text" name="char2" maxlength="1">
    <br>
    <input type="submit" value="Comprobar">
</form>
