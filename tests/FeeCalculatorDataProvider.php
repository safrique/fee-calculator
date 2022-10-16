<?php

namespace Lendable\Interview\Interpolation\Tests;

use Lendable\Interview\Interpolation\Model\FeeCalculator;
use Lendable\Interview\Interpolation\Model\LoanApplication;

class FeeCalculatorDataProvider extends FeeCalculationDataProvider
{
    /**
     * Tests the fee calculations
     *
     * @dataProvider feeProvider
     * @param int   $term
     * @param float $amount
     * @param float $expected
     */
    public function testFee(int $term, float $amount, float $expected)
    {
        $application = new LoanApplication($term, $amount);
        $fee = (new FeeCalculator())->calculate($application);
        $this->assertEquals($expected, $fee);
    }
}