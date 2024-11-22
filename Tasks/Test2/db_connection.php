<?php
class DBConnection {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function saveEventData($eventData) {
        // Prepare the SQL statement with the correct number of placeholders
        $stmt = $this->conn->prepare("INSERT INTO participantes 
            (nombre, apellido, edad, sexo, pais_residencia, nacionalidad, celular, correo, temas, observaciones, fecha) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind the parameters with correct data types
        $stmt->bind_param(
            'ssissssssss',  // Type definitions for the 11 values
            $eventData->nombre,
            $eventData->apellido,
            $eventData->edad,
            $eventData->sexo,
            $eventData->pais_residencia,
            $eventData->nacionalidad,
            $eventData->celular,
            $eventData->correo,
            $eventData->temas,
            $eventData->observaciones,
            $eventData->fecha
        );

        // Execute the statement
        if ($stmt->execute()) {
            echo "Registro guardado exitosamente";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
    }

    public function closeConnection() {
        $this->conn->close();
    }
}