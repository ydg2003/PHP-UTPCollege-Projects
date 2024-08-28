<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $radius = $_POST['radius'];

    // Calculate the perimeter
    $perimeter = 2 * pi() * $radius;

    // Display the result
    echo "<h2>Result:</h2>";
    echo "Perimeter = ". number_format($perimeter, 2) . ".";
    echo "<br><br>";
} else {
    // If accessed directly, redirect to the form
    header("Location: index.php");
    exit();
}
?>