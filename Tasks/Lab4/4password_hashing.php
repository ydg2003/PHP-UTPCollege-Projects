<?php
/* 
General documentation explaining what this code does:

This PHP script demonstrates the usage of password hashing and verification techniques using `password_hash()` and `password_verify()`. It performs the following tasks:
1. **Password Hashing with `password_hash()`**:
   - It hashes the string `'Password'` using the `PASSWORD_DEFAULT` algorithm, which typically uses the bcrypt algorithm.
   - The `password_hash()` function returns a hashed version of the password.
   - The hashed password is displayed using `sprintf()` for formatted output.

2. **Password Verification with `password_verify()`**:
   - The script verifies whether the given password (`'Password'`) matches the stored hash.
   - It uses the `password_verify()` function to check if the user-provided password matches the hashed password.
   - If the password is valid (i.e., matches the hash), it outputs "La contraseña es válida!" (The password is valid).
   - If the password is invalid (i.e., does not match the hash), it outputs "La contraseña no es válida." (The password is not valid).
*/
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