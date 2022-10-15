<?php

namespace Lendable\Interview\Interpolation\Tests;

use Lendable\Interview\Interpolation\Model\LoanApplication;
use PHPUnit\Framework\TestCase;

class LoanApplicationTest extends TestCase
{
    /**
     * Tests the loan application values
     *
     * @dataProvider loanApplicationProvider
     *
     * @param int   $term
     * @param float $amount
     * @param array $expected
     */
    public function testLoanApplicationValues(int $term, float $amount, array $expected)
    {
        $application = new LoanApplication($term, $amount);
        $applicationDetails = ['term' => $application->term(), 'amount' => $application->amount()];
        $this->assertEquals($expected, $applicationDetails);
    }

    /**
     * Tests the loan application has term attribute
     *
     * @dataProvider loanApplicationProvider
     *
     * @param int   $term
     * @param float $amount
     */
    public function testLoanApplicationHasTermAttribute(int $term, float $amount)
    {
        $this->assertObjectHasAttribute('term', new LoanApplication($term, $amount));
    }

    /**
     * Tests the loan application has amount attribute
     *
     * @dataProvider loanApplicationProvider
     *
     * @param int   $term
     * @param float $amount
     */
    public function testLoanApplicationHasAmountAttribute(int $term, float $amount)
    {
        $this->assertObjectHasAttribute('amount', new LoanApplication($term, $amount));
    }

    /**
     * Provides the test data for testing the fee calculations
     *
     * @return array[]
     */
    public function loanApplicationProvider()
    : array
    {
        return [
            [12, 11500, ['term' => 12, 'amount' => 11500]],
            [24, 12345, ['term' => 24, 'amount' => 12345]],
            [12, 3456.23, ['term' => 12, 'amount' => 3456.23]],
            [24, 6587.99, ['term' => 24, 'amount' => 6587.99]],
        ];
    }
}