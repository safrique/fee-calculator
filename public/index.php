<?php

require '../vendor/autoload.php';

use Lendable\Interview\Interpolation\Model\FeeCalculator;
use Lendable\Interview\Interpolation\Model\LoanApplication;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Loan Calculator</title>
</head>
<body>
<h1>Loan Calculator</h1>

<form action="">
    <input type="submit" value="Reset">
</form>

<form action="" method="post">
    <label for="amount">Amount<label>
            <input type="number" step=".01" min="1000" max="20000" name="amount"
                   value="<?php
                   echo $_POST['amount'] ?? 1000 ?>" id="amount">
            <label for="term">Term<label>
                    <select name="term" id="term">
                        <?php
                        if (!empty($_POST['term'])) {
                            echo '<option value="' . $_POST['term'] . '">' . $_POST['term'] . '</option>';
                        }
                        ?>
                        <option value="12">12</option>
                        <option value="24">24</option>
                    </select>
                    <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $term = $_POST['term'];
    $amount = $_POST['amount'];
    $application = new LoanApplication($term, $amount);
    $fee = (new FeeCalculator())->calculate($application);
    echo "<br>The fee on the loan is £$fee";
}
?>
</body>
</html>