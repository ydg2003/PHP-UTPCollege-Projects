<?php //event_data_controller
require_once 'db_conn.php';

class EventData {
    public $nombre;
    public $apellido;
    public $edad;
    public $sexo;
    public $paisResidencia; // Updated to camelCase
    public $nacionalidad;
    public $celular;
    public $correo;
    public $temas;
    public $observaciones;
    public $fecha;

    public function __construct($data) {
        // Set the form data to class properties, sanitize if necessary
        $this->nombre = ucfirst(strtolower($data['nombre']));
        $this->apellido = ucfirst(strtolower($data['apellido']));
        $this->edad = intval($data['edad']);
        $this->sexo = $data['sexo'];
        $this->paisResidencia = $data['pais_residencia']; // Updated to camelCase
        $this->nacionalidad = $data['nacionalidad'];
        $this->celular = $data['celular'];
        $this->correo = $data['correo'];
        $this->temas = implode(', ', $data['temas']); // Convert array to comma-separated string
        $this->observaciones = $data['observaciones'];
        $this->fecha = $data['fecha']; // Auto-generated date
    }

    public function saveEventData($eventData) {
        global $db; // Use the global $db PDO object

        // Prepare the SQL statement with placeholders
        $query = "INSERT INTO participantes
                  (nombre, apellido, edad, sexo, pais_residencia, nacionalidad, celular, correo, temas, observaciones, fecha)
                  VALUES (:nombre, :apellido, :edad, :sexo, :pais_residencia, :nacionalidad, :celular, :correo, :temas, :observaciones, :fecha)";

        // Prepare the statement
        $stmt = $db->prepare($query);

        // Bind the parameters to the placeholders
        $stmt->bindParam(':nombre', $eventData->nombre);
        $stmt->bindParam(':apellido', $eventData->apellido);
        $stmt->bindParam(':edad', $eventData->edad);
        $stmt->bindParam(':sexo', $eventData->sexo);
        $stmt->bindParam(':pais_residencia', $eventData->paisResidencia); // Updated to camelCase
        $stmt->bindParam(':nacionalidad', $eventData->nacionalidad);
        $stmt->bindParam(':celular', $eventData->celular);
        $stmt->bindParam(':correo', $eventData->correo);
        $stmt->bindParam(':temas', $eventData->temas);
        $stmt->bindParam(':observaciones', $eventData->observaciones);
        $stmt->bindParam(':fecha', $eventData->fecha);

        // Execute the statement
        try {
            $stmt->execute();
            echo "Registro guardado exitosamente";
            ?>
            <!DOCTYPE html>
            <html>
                <body>
                    <p>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                            <li><a href="registered.html">Registrados</a></li>
                        </ul>
                    </p>
                </body>
            </html>
            <?php
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Method to close the PDO connection (optional as it will auto-close)
    public function closeConnection() {
        $this->conn = null;
    }
}
?>