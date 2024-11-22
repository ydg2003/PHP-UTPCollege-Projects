<?php
class Password {
    const SALT = 'EstoEsUnSalt';

    public static function hash($password) {
        return hash('sha512', self::SALT . $password);
    }

    public static function verify($password, $hash) {
        return ($hash === self::hash($password));
    }
}

// Create the password hash
$hash = Password::hash('micontraseña');

// Verify the entered password
if (Password::verify('micontraseña', $hash)) {
    echo 'Contraseña correcta!\n';
} else {
    echo "Contraseña incorrecta!\n";
}
?>