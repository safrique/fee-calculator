<?php

require 'vendor/autoload.php';

use Lendable\Interview\Interpolation\Model\FeeCalculator;
use Lendable\Interview\Interpolation\Model\LoanApplication;
use Lendable\Interview\Interpolation\Validators\LoanAmountValidator;
use Lendable\Interview\Interpolation\Validators\LoanTermValidator;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loan Calculator</title>

    <!-- Add icon library -->
    <script src="https://kit.fontawesome.com/d49395a1f2.js" crossorigin="anonymous"></script>

    <!-- Style Sheet -->
    <link rel="stylesheet" href="public/assets/css/form.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="public/assets/img/icons8-wallet-16.png">
</head>
<body>
<form action="" style="max-width:500px; margin:auto">
    <h1>Loan Calculator</h1>

    <div class="input-container">
        <button type="submit" class="btn"><i class="fa-solid fa-arrow-rotate-right"></i> Reset</button>
    </div>
</form>

<form action="" method="post" style="max-width:500px; margin:auto">
    <div class="label">
        <label for="amount">Loan Amount:</label>
    </div>
    <div class="input-container">
        <i class="fa-solid fa-sterling-sign icon"></i>
        <input class="input-field" type="number" step=".01" min="1000" max="20000" name="amount"
               value="<?php
               echo $_POST['amount'] ?? 1000 ?>" id="amount">
    </div>

    <div class="label">
        <label for="term">Term (months):</label>
    </div>
    <div class="input-container">
        <i class="fa-solid fa-calendar-days icon"></i>
        <select class="input-field" name="term" id="term">
            <?php
            if (!empty($_POST['term'])) {
                echo '<option value="' . $_POST['term'] . '">' . $_POST['term'] . '</option>';
            }

            $terms = LoanTermValidator::getAvailableTerms();
            foreach ($terms as $term) {
                if (empty($_POST['term']) || $term != $_POST['term']) {
                    echo "<option value='$term'>$term</option>";
                }
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn"><i class="fa-solid fa-paper-plane"></i> Submit</button>

    <div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                echo '<br>';
                $term = htmlentities($_POST['term']);

                if (!is_numeric($term)) {
                    echo "Invalid loan term <span class='error'>$term</span> - has to be numeric";
                    exit();
                }

                $term = (int)$term;

                if (!($termValidated = LoanTermValidator::validateTerm($term))) {
                    echo "Invalid loan term <span class='error'>$term</span> months";
                    exit();
                }

                $amount = htmlentities($_POST['amount']);

                if (!is_numeric($amount)) {
                    echo "Invalid loan amount <span class='error'>$amount</span> - has to be numeric";
                    exit();
                }

                $amount = round((float)$amount, 2);

                if (!($amountValidated = LoanAmountValidator::validateAmount($amount))) {
                    echo "Invalid loan amount <span class='error'>&pound;$amount</span>";
                    exit();
                }

                $application = new LoanApplication($term, $amount);
                $fee = (new FeeCalculator())->calculate($application);
                ?>
                <div style="max-width:500px; margin:auto">
                    <h3>Loan Schedule:</h3>
                    <table>
                        <tbody>
                        <tr>
                            <td>Term:</td>
                            <td><?php
                                echo $term ?> months
                            </td>
                        </tr>
                        <tr>
                            <td>Loan Amount:</td>
                            <td>&pound;<?php
                                echo number_format($amount, 2) ?></td>
                        </tr>
                        <tr>
                            <td>Loan Fee:</td>
                            <td><b>&pound;<?php
                                    echo number_format($fee, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td>Total Repayable:</td>
                            <td>&pound;<?php
                                echo number_format($amount + $fee, 2) ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php
            } catch (Exception $e) {
                echo 'An error occurred: <span class="error">' . $e->getMessage() . '</span>';
            }
        }
        ?>
    </div>
</form>
</body>
</html>