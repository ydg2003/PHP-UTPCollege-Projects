<?php
//download_xlsx.php
require_once 'vendor/autoload.php'; // Include PhpSpreadsheet library
require_once 'login.php'; // Include your PDO connection setup

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$db = new PDO("mysql:host=localhost;dbname=evento", "root", "");
// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Participantes');

// Set headers for the table
$headers = ['ID', 'Nombre', 'Apellido', 'Edad', 'Sexo', 'País de Residencia', 'Nacionalidad', 'Celular', 'Correo', 'Temas', 'Observaciones', 'Fecha'];
$sheet->fromArray($headers, NULL, 'A1');


// Fetch data from the 'participantes' table
$sql = "SELECT * FROM participantes";
$stmt = $db->query($sql); // Using PDO's query method

// Use fetchAll to retrieve all the data
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Populate data in the spreadsheet
$rowNum = 2;
foreach ($data as $row) {
    $sheet->fromArray(array_values($row), NULL, 'A' . $rowNum);
    $rowNum++;
}

// Output file
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="participantes.xlsx"');
$writer->save('php://output');

exit();