<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation;

use Lendable\Interview\Interpolation\Model\LoanApplication;

interface FeeCalculatorInterface
{
    /**
     * The calculated total fee
     *
     * @param LoanApplication $application
     *
     * @return float
     */
    public function calculate(LoanApplication $application)
    : float;
}
