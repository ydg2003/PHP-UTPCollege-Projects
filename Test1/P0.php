<?php
    class Person {
        // Definir propiedades con modificadores de acceso
        public $name;
        public $surname;
        public $age;

        // Constructor de la clase
        function __construct($name, $surname, $age) {
            // Asignar valores a las propiedades
            $this->name = $name;
            $this->surname = $surname;
            $this->age = $age;
        }
    }

    // Ejemplo de uso:
    $persona = new Person("Fidel", "Diaz", 21);
    echo "Nombre: " . $persona->name . "<br>";
    echo "Apellido: " . $persona->surname . "<br>";
    echo "Edad: " . $persona->age . "<br>";
?>