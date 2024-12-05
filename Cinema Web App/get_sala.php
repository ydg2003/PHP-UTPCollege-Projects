<?php
include 'DatabaseHelper.php';
$db = new DatabaseHelper();

if (isset($_GET['pelicula']) && isset($_GET['sucursal'])) {
    $pelicula_id = $_GET['pelicula'];
    $sucursal_id = $_GET['sucursal'];

    $query = "SELECT id, nombre FROM salas WHERE sucursal_id = ? AND id IN (SELECT sala_id FROM boletos WHERE pelicula_id = ?)";
    $stmt = $db->conn->prepare($query);
    $stmt->bind_param("ii", $sucursal_id, $pelicula_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
    }
}
?>
