<?php

require '../vendor/autoload.php';
use Lendable\Interview\Interpolation\Model\FeeCalculator;
use Lendable\Interview\Interpolation\Model\LoanApplication;

$term = $_POST['term'];
$amount = $_POST['amount'];
$application = new LoanApplication($term, $amount);
$fee = (new FeeCalculator())->calculate($application);
echo "The fee on the loan is £$fee";