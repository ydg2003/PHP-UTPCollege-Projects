<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

// Handle search input
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
}

$db = new PDO("mysql:host=localhost;dbname=evento", "root", "");

// Define number of records per page
$recordsPerPage = 10;

// Current page number
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startFrom = ($currentPage - 1) * $recordsPerPage;

// Fetch data with search and pagination
$sql = "SELECT * FROM participantes WHERE nombre LIKE :search OR apellido LIKE :search LIMIT :startFrom, :recordsPerPage";
$stmt = $db->prepare($sql);

$searchParam = "%" . $searchQuery . "%";
$stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
$stmt->bindParam(':startFrom', $startFrom, PDO::PARAM_INT);
$stmt->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count total records for pagination
$countSql = "SELECT COUNT(*) FROM participantes WHERE nombre LIKE :search OR apellido LIKE :search";
$countStmt = $db->prepare($countSql);
$countStmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
$countStmt->execute();

$totalRecords = $countStmt->fetchColumn();
$totalPages = ceil($totalRecords / $recordsPerPage);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registro de Participantes</title>
    <style>
        .pagination {
            display: inline-block;
            margin-top: 20px;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Registro de Participantes</h1>

    <form method="GET" action="record.php">
        <input type="text" name="search" placeholder="Buscar por nombre o apellido" value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit">Buscar</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>País de Residencia</th>
                <th>Nacionalidad</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Temas</th>
                <th>Observaciones</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($result)) {
                foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($row['edad']); ?></td>
                        <td><?php echo htmlspecialchars($row['sexo']); ?></td>
                        <td><?php echo htmlspecialchars($row['pais_residencia']); ?></td>
                        <td><?php echo htmlspecialchars($row['nacionalidad']); ?></td>
                        <td><?php echo htmlspecialchars($row['celular']); ?></td>
                        <td><?php echo htmlspecialchars($row['correo']); ?></td>
                        <td><?php echo htmlspecialchars($row['temas']); ?></td>
                        <td><?php echo htmlspecialchars($row['observaciones']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="12">No se encontraron resultados</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                echo "<a class='active' href='?page=$i&search=" . urlencode($searchQuery) . "'>$i</a>";
            } else {
                echo "<a href='?page=$i&search=" . urlencode($searchQuery) . "'>$i</a>";
            }
        }
        ?>
    </div>

    <a href="download_xlsx.php">Descargar como XLSX</a>
    <a href="home.php">Volver a Inicio</a>
</body>
</html>