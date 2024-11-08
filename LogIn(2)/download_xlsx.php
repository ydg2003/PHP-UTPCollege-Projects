<?php
require 'vendor/autoload.php'; // Include PhpSpreadsheet library
require 'db_connection.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Participantes');

// Set headers for the table
$headers = ['ID', 'Nombre', 'Apellido', 'Edad', 'Sexo', 'País de Residencia', 'Nacionalidad', 'Celular', 'Correo', 'Temas', 'Observaciones', 'Fecha'];
$sheet->fromArray($headers, NULL, 'A1');

// Fetch data from 'participantes' table
$conn = new DBConnection('127.0.0.1', 'root', '', 'evento'); // Update with your DB credentials
$result = $conn->conn->query("SELECT * FROM participantes");

// Populate data in the spreadsheet
$rowNum = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->fromArray(array_values($row), NULL, 'A' . $rowNum);
    $rowNum++;
}

// Output file
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="participantes.xlsx"');
$writer->save('php://output');

$conn->closeConnection();
exit();
?>