<?php

namespace Lendable\Interview\Interpolation\Model;

use Lendable\Interview\Interpolation\FeeCalculatorInterface;
use Lendable\Interview\Interpolation\Helpers\CalculationHelper;
use Lendable\Interview\Interpolation\Helpers\FeesHelper;

class FeeCalculator implements FeeCalculatorInterface
{
    use CalculationHelper;
    use FeesHelper;

    /**
     * @param LoanApplication $application
     *
     * @return float
     */
    public function calculate(LoanApplication $application)
    : float {
        $term = $application->term();
        $amount = $application->amount();

        if (!is_array($feeBounds = $this->getFeeBounds($term, $amount))) {
            return $feeBounds;
        }

        $fee = $this->interpolateFeeLinearly($amount, $feeBounds);
        $total = $this->roundUpToAny($fee + $amount);
        return round($total - $amount, 2);
    }
}