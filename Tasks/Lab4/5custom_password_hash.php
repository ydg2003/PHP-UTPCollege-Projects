<?php
/* 
General documentation explaining what this code does:

This PHP script defines a `Password` class with static methods for hashing and verifying passwords using a custom salt value. It performs the following operations:
1. **Password Hashing (`hash()` method)**:
   - The `hash()` method takes a password as input, concatenates it with a predefined salt (`SALT`), and then hashes the combined string using the `sha512` hashing algorithm.
   - The salt (`SALT`) is defined as a constant within the class, which adds an additional layer of security to the password hashing process.

2. **Password Verification (`verify()` method)**:
   - The `verify()` method compares the given password, hashed with the same salt, to the previously stored hash.
   - It checks if the hash of the provided password matches the stored hash.

3. **Hash Creation**:
   - The script creates a password hash for the password `'micontraseña'` by calling the `hash()` method of the `Password` class.

4. **Password Verification**:
   - The script verifies if the entered password (`'micontraseña'`) matches the stored hash using the `verify()` method.
   - If the password matches, it outputs "Contraseña correcta!" (Correct password).
   - If the password does not match, it outputs "Contraseña incorrecta!" (Incorrect password).
*/
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