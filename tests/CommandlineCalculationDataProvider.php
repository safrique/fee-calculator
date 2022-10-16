<?php

namespace Lendable\Interview\Interpolation\Tests;

class CommandlineCalculationDataProvider extends FeeCalculationDataProvider
{
    /**
     * Tests the calculation response is a string
     *
     * @dataProvider feeProvider
     *
     * @param int   $term
     * @param float $amount
     */
    public function testCalculationReturnsString(int $term, float $amount)
    {
        $output = `cd Commands && php calculateFee.php --term=$term --amount=$amount`;
        $this->assertIsString($output);
    }

    /**
     * Tests the calculation output equals the given string value, which ensures the calculated fee is correct
     *
     * @dataProvider feeProvider
     *
     * @param int   $term
     * @param float $amount
     * @param float $fee
     */
    public function testCalculationEqualsValue(int $term, float $amount, float $fee)
    {
        $output = `cd Commands && php calculateFee.php --term=$term --amount=$amount`;
        $value = "Loan Schedule:\nTerm: $term months\nLoan Amount: £" . number_format($amount, 2);
        $value .= "\nLoan Fee: £" . number_format($fee, 2);
        $value .= "\nTotal Repayable: £" . number_format($amount + $fee, 2);
        $this->assertEquals($value, $output);
    }
}