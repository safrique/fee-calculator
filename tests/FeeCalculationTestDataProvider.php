<?php

namespace Lendable\Interview\Interpolation\Tests;

use PHPUnit\Framework\TestCase;

abstract class FeeCalculationTestDataProvider extends TestCase
{
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