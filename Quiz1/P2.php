<?php
// Definir la variable con el valor deseado
$favourite_site = "Business";

// Usar la estructura switch para manejar los diferentes casos
switch ($favourite_site) {
    case "Business":
        echo "My favourite site is business.tutsplus.com!\n";
        break;
    case "Code":
        echo "My favourite site is code.tutsplus.com!\n";
        break;
    case "Web Design":
        echo "My favourite site is webdesign.tutsplus.com!\n";
        break;
    case "Music":
        echo "My favourite site is music.tutsplus.com!\n";
        break;
    case "Photography":
        echo "I like everything at tutsplus.com!\n";
        break;
    default:
        echo "Invalid choice!\n";
        break;
}
?>