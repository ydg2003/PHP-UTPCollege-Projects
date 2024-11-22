<?php
// Using crypt() and password_hash() to hash passwords
$str = 'Password';
echo sprintf("Result of DEFAULT on %s is %s\n", $str, password_hash($str, PASSWORD_DEFAULT));

$hash = password_hash($str, PASSWORD_DEFAULT);

if (password_verify($str, $hash)) {
    echo 'La contraseña es válida!';
} else {
    echo 'La contraseña no es válida.';
}
?>