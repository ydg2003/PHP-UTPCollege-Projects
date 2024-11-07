<?php
function calculateOperations($a, $b) {
    $results = [];

    $results['addition'] = $a + $b;
    $results['subtraction'] = $a - $b;
    $results['multiplication'] = $a * $b;
    $results['division'] = ($b != 0) ? $a / $b : "Division by zero error";
    $results['modulus'] = ($b != 0) ? $a % $b : "Division by zero error";

    return $results;
}

function roundingOperations($a) {
    $results = [];

    $results['round'] = round($a);
    $results['ceil'] = ceil($a);
    $results['floor'] = floor($a);

    return $results;
}

// Define the numbers
$a = 10;
$b = 3;

// Calculate operations for two numbers
$operations = calculateOperations($a, $b);

// Calculate rounding operations for one number
$rounding = roundingOperations(0.61);

// Echo the results of the operations
echo "a + b = " . $operations['addition'] . "\n";
echo "a - b = " . $operations['subtraction'] . "\n";
echo "a * b = " . $operations['multiplication'] . "\n";
echo "a / b = " . $operations['division'] . "\n";
echo "a % b = " . $operations['modulus'] . "\n";

// Echo the results of the rounding operations
echo "round(0.61) = " . $rounding['round'] . "\n";
echo "ceil(0.61) = " . $rounding['ceil'] . "\n";
echo "floor(0.61) = " . $rounding['floor'] . "\n";
?>