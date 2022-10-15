<?php

namespace Lendable\Interview\Interpolation\Validators;

class LoanAmountValidator
{
    /**
     * Returns the loan amount bounds
     *
     * @return float[]
     */
    public static function getLoanAmountBounds()
    : array
    {
        return [1000, 20000];
    }

    /**
     * Validates the loan amount
     *
     * @param float $amount
     *
     * @return bool
     */
    public static function validateAmount(float $amount)
    : bool {
        $amountBounds = self::getLoanAmountBounds();
        return $amount >= $amountBounds[0] && $amount <= $amountBounds[1];
    }
}