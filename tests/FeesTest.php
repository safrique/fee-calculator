<?php

namespace Lendable\Interview\Interpolation\Tests;

use Lendable\Interview\Interpolation\Helpers\CalculationHelper;
use Lendable\Interview\Interpolation\Helpers\FeesHelper;
use PHPUnit\Framework\TestCase;

class FeesTest extends TestCase
{
    use CalculationHelper;
    use FeesHelper;

    /**
     * Tests the fees list for 12 months returned is an array
     */
    public function testFeeList12MonthsIsArray()
    {
        $this->assertIsArray($this->getFeeListByTerm(12));
    }

    /**
     *  Tests the fees list for 24 months returned is an array
     */
    public function testFeeList24MonthsIsArray()
    {
        $this->assertIsArray($this->getFeeListByTerm(24));
    }

    /**
     * Tests the correct fees list for 12 months is returned
     */
    public function testFeeList12Months()
    {
        $list = [
            ['amount' => 1000, 'fee' => 50],
            ['amount' => 2000, 'fee' => 90],
            ['amount' => 3000, 'fee' => 90],
            ['amount' => 4000, 'fee' => 115],
            ['amount' => 5000, 'fee' => 100],
            ['amount' => 6000, 'fee' => 120],
            ['amount' => 7000, 'fee' => 140],
            ['amount' => 8000, 'fee' => 160],
            ['amount' => 9000, 'fee' => 180],
            ['amount' => 10000, 'fee' => 200],
            ['amount' => 11000, 'fee' => 220],
            ['amount' => 12000, 'fee' => 240],
            ['amount' => 13000, 'fee' => 260],
            ['amount' => 14000, 'fee' => 280],
            ['amount' => 15000, 'fee' => 300],
            ['amount' => 16000, 'fee' => 320],
            ['amount' => 17000, 'fee' => 340],
            ['amount' => 18000, 'fee' => 360],
            ['amount' => 19000, 'fee' => 380],
            ['amount' => 20000, 'fee' => 400],
        ];
        $this->assertEquals($this->getFeeListByTerm(12), $list);
    }

    /**
     *  Tests the correct fees list for 24 months is returned
     */
    public function testFeeList24Months()
    {
        $list = [
            ['amount' => 1000, 'fee' => 70],
            ['amount' => 2000, 'fee' => 100],
            ['amount' => 3000, 'fee' => 120],
            ['amount' => 4000, 'fee' => 160],
            ['amount' => 5000, 'fee' => 200],
            ['amount' => 6000, 'fee' => 240],
            ['amount' => 7000, 'fee' => 280],
            ['amount' => 8000, 'fee' => 320],
            ['amount' => 9000, 'fee' => 360],
            ['amount' => 10000, 'fee' => 400],
            ['amount' => 11000, 'fee' => 440],
            ['amount' => 12000, 'fee' => 480],
            ['amount' => 13000, 'fee' => 520],
            ['amount' => 14000, 'fee' => 560],
            ['amount' => 15000, 'fee' => 600],
            ['amount' => 16000, 'fee' => 640],
            ['amount' => 17000, 'fee' => 680],
            ['amount' => 18000, 'fee' => 720],
            ['amount' => 19000, 'fee' => 760],
            ['amount' => 20000, 'fee' => 800],
        ];
        $this->assertEquals($this->getFeeListByTerm(24), $list);
    }

    /**
     * Tests that the correct value is returned when using the minimum amount for 12 months
     */
    public function testLowerBoundFee12Months()
    {
        $this->assertEquals(50, $this->getFeeBounds(12, 1000));
    }

    /**
     * Tests that the correct value is returned when using the minimum amount for 24 months
     */
    public function testLowerBoundFee24Months()
    {
        $this->assertEquals(70, $this->getFeeBounds(24, 1000));
    }

    /**
     * Tests that the correct bounds are returned for the maximum amount for 12 months
     */
    public function testUpperBoundFee12Months()
    {
        $bounds = [['amount' => 19000, 'fee' => 380], ['amount' => 20000, 'fee' => 400]];
        $this->assertEquals($bounds, $this->getFeeBounds(12, 20000));
    }

    /**
     * Tests that the correct bounds are returned for the maximum amount for 24 months
     */
    public function testUpperBoundFee24Months()
    {
        $bounds = [['amount' => 19000, 'fee' => 760], ['amount' => 20000, 'fee' => 800]];
        $this->assertEquals($bounds, $this->getFeeBounds(24, 20000));
    }

    /**
     * @dataProvider roundProvider
     *
     * @param float $amount
     * @param float $expected
     */
    public function testRoundUp(float $amount, float $expected)
    : void {
        $this->assertSame($expected, $this->roundUpToAny($amount));
    }

    /**
     * Returns data for the testRoundUp method to test
     *
     * @return array[]
     */
    public function roundProvider()
    : array
    {
        return [
            [50.25, 55],
            [1234.23, 1235],
            [2369.32, 2370],
            [12345.67, 12350],
        ];
    }

    /**
     * @dataProvider interpolateProvider
     *
     * @param float $amount
     * @param array $bounds
     * @param float $expected
     */
    public function testInterpolation(float $amount, array $bounds, float $expected)
    : void {
        $this->assertSame($expected, round($this->interpolateFeeLinearly($amount, $bounds), 2));
    }

    /**
     * Returns data for the testInterpolation method to test
     *
     * @return array[]
     */
    public function interpolateProvider()
    : array
    {
        return [
            [12345, [['amount' => 12000, 'fee' => 240], ['amount' => 13000, 'fee' => 260]], 246.9],
            [2345.67, [['amount' => 2000, 'fee' => 100], ['amount' => 3000, 'fee' => 120]], 106.91],
            [5678.23, $this->getFeeBounds(12, 5678.23), 113.56],
            [18326.13, $this->getFeeBounds(24, 18326.13), 733.05],
        ];
    }
}