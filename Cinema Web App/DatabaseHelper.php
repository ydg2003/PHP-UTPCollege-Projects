<?php
class DatabaseHelper {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cine_DB";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function executeQuery($query) {
        return $this->conn->query($query);
    }

    public function executeUpdate($query, $params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiii", ...$params);
        return $stmt->execute();
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>

