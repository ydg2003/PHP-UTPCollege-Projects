<!DOCTYPE html>
    <body>
    <?php
    // Coefficients
    $a = 1;
    $b = -3;
    $c = 2;
    // Calculate the discriminant
    $discriminant = ($b * $b) - (4 * $a * $c);
    
    if ($discriminant >= 0) {
    // Calculate the first root (X1)
    $x1 = (-$b + sqrt($discriminant)) / (2 * $a);
    echo "The root X1 is: " . $x1;
    } else {
        echo "The equation has complex roots.";
    }
    ?>
    </body>
</html>