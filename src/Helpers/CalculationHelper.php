<?php

namespace Lendable\Interview\Interpolation\Helpers;

trait CalculationHelper
{
    /**
     * Calculates the fee based on the linear interpolation of the lower & upper bounds
     *
     * @param float $amount
     * @param array $feeBounds
     *
     * @return float
     */
    private function interpolateFeeLinearly(float $amount, array $feeBounds)
    : float {
        // Linear Interpolation formula:
        //  (y - y0) / (x - x0) = (y1 - y0) / (x1 - x0)
        //  i.e. y = y0 + (x - x0) * (y1 - y0) / (x1 - x0)
        //  y = fee & x = amount
        return $feeBounds[0]['fee'] + ($amount - $feeBounds[0]['amount']) * ($feeBounds[1]['fee'] - $feeBounds[0]['fee']) / ($feeBounds[1]['amount'] - $feeBounds[0]['amount']);
    }

    /**
     * Rounds an amount up to the nearest multiple of 5
     *
     * @param float $amount
     * @param int   $nearest
     *
     * @return float
     */
    private function roundUpToAny(float $amount, int $nearest = 5)
    : float {
        return (ceil($amount) % $nearest == 0) ? ceil($amount) : round(($amount + $nearest / 2) / $nearest) * $nearest;
    }
}