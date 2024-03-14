<!DOCTYPE html>
<html>
<head>
    <title>Simple Calculator</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Number 1</label>
        <input type="number" id="num1" name="number1"><br>
        <label>Number 2</label>
        <input type="number" id="num2" name="number2"><br>
        <label for="">Choose Operation:</label>
        <select name="operation" id="operation">
            <option value="addition">Addition</option>
            <option value="subtraction">Subtraction</option>
            <option value="multiplication">Multiplication</option>
            <option value="division">Division</option>
        </select>
        <input type="submit" name="submit" value="Calculate"><br>
    </form>

    <div id="result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if form was submitted

            // Get values from form
            $num1 = $_POST['number1'];
            $num2 = $_POST['number2'];
            $operation = $_POST['operation'];

            // Perform calculation based on selected operation
            switch ($operation) {
                case 'addition':
                    $result = $num1 + $num2;
                    echo "Result: $num1 + $num2 = $result";
                    break;
                case 'subtraction':
                    $result = $num1 - $num2;
                    echo "Result: $num1 - $num2 = $result";
                    break;
                case 'multiplication':
                    $result = $num1 * $num2;
                    echo "Result: $num1 * $num2 = $result";
                    break;
                case 'division':
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                        echo "Result: $num1 / $num2 = $result";
                    } else {
                        echo "Cannot divide by zero";
                    }
                    break;
                default:
                    echo "Invalid operation";
                    break;
            }
        }
        ?>
    </div>
</body>
</html>
