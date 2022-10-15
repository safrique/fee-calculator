<?php

namespace Lendable\Interview\Interpolation\Tests;

use Lendable\Interview\Interpolation\Model\FeeCalculator;
use Lendable\Interview\Interpolation\Model\LoanApplication;
use PHPUnit\Framework\TestCase;

class FeeCalculatorTest extends TestCase
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

    /**
     * Provides the test data for testing the fee calculations
     *
     * @return float[][]
     */
    public function feeProvider()
    : array
    {
        return [
            [24, 11500, 460],
            [12, 19250, 385],
            [24, 2750, 115],
            [12, 12345, 250],
            [12, 3254.98, 100.02],
            [24, 5623.13, 226.87],
        ];
    }
}