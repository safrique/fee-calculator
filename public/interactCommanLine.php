<?php

require '../vendor/autoload.php';
use Lendable\Interview\Interpolation\Model\FeeCalculator;
use Lendable\Interview\Interpolation\Model\LoanApplication;

fwrite(STDOUT, "Please select the term as 12 or 24 months\n");
$term = fgets(STDIN);

fwrite(STDOUT, "Please enter a loan amount between £1000 & £20000\n");
$amount = fgets(STDIN);

$application = new LoanApplication($term, $amount);
$fee = (new FeeCalculator())->calculate($application);
fwrite(STDOUT, "The fee on the loan is £$fee");