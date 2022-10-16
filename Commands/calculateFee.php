<?php

require '../vendor/autoload.php';

use Lendable\Interview\Interpolation\Model\FeeCalculator;
use Lendable\Interview\Interpolation\Model\LoanApplication;
use Lendable\Interview\Interpolation\Validators\LoanAmountValidator;
use Lendable\Interview\Interpolation\Validators\LoanTermValidator;

/**
 * Optional parameters for the term & amount can be added via the command line
 */
if ($args = getopt('', ['term::', 'amount::'])) {
    foreach ($args as $key => $value) {
        if ($key == 'term' && LoanTermValidator::validateTerm($value = (int)$value)) {
            $term = $value;
        }

        if ($key == 'amount' && LoanAmountValidator::validateAmount($value = (float)$value)) {
            $amount = $value;
        }
    }
}

/**
 * Checks if the term has been provided & prompts the user to enter a value until a valid value is provided
 */
$term = $term ?? 0;

while (!LoanTermValidator::validateTerm($term)) {
    fwrite(STDOUT, "Please select the term as 12 or 24 months\n");
    fscanf(STDIN, "%i\n", $term);

    if (!LoanTermValidator::validateTerm($term)) {
        fwrite(STDOUT, "The term entered is not 12 or 24 months. Please try again.\n");
    }
}

/**
 * Checks if the amount has been provided & prompts the user to enter a value until a valid value is provided
 */
$amount = $amount ?? 0;

while (!LoanAmountValidator::validateAmount($amount)) {
    fwrite(STDOUT, "Please enter a loan amount between £1000 & £20000\n");
    fscanf(STDIN, "%f\n", $amount);

    if (!LoanAmountValidator::validateAmount($amount)) {
        fwrite(STDOUT, "The amount entered is not between £1000 & £20000. Please try again.\n");
    }
}

/**
 * Calculate the fee
 */
$application = new LoanApplication($term, $amount);
$fee = (new FeeCalculator())->calculate($application);

/**
 * Puts the loan schedule together & writes it on the command line screen
 */
$message = "Loan Schedule:\nTerm: $term months\nLoan Amount: £" . number_format($amount, 2);
$message .= "\nLoan Fee: £" . number_format($fee, 2);
$message .= "\nTotal Repayable: £" . number_format($amount + $fee, 2);
fwrite(STDOUT, $message);