<?php

require '../vendor/autoload.php';

use Lendable\Interview\Interpolation\Model\FeeCalculator;
use Lendable\Interview\Interpolation\Model\LoanApplication;
use Lendable\Interview\Interpolation\Validators\LoanAmountValidator;
use Lendable\Interview\Interpolation\Validators\LoanTermValidator;

$term = 0;

while (!LoanTermValidator::validateTerm($term)) {
    fwrite(STDOUT, "Please select the term as 12 or 24 months\n");
    fscanf(STDIN, "%i\n", $term);

    if (!LoanTermValidator::validateTerm($term)) {
        fwrite(STDOUT, "The term entered is not 12 or 24 months. Please try again.\n");
    }
}

$amount = 0;

while (!LoanAmountValidator::validateAmount($amount)) {
    fwrite(STDOUT, "Please enter a loan amount between £1000 & £20000\n");
    fscanf(STDIN, "%f\n", $amount);

    if (!LoanAmountValidator::validateAmount($amount)) {
        fwrite(STDOUT, "The amount entered is not between £1000 & £20000. Please try again.\n");
    }
}

$application = new LoanApplication($term, $amount);
$fee = (new FeeCalculator())->calculate($application);
fwrite(STDOUT, "The fee on the loan is £$fee");