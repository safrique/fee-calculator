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
     * Calculates the loan fee
     *
     * @param LoanApplication $application
     *
     * @return float
     */
    public function calculate(LoanApplication $application)
    : float {
        $term = $application->term();
        $amount = $application->amount();

        if ($fee = $this->getCache($cacheFile = $this->getCacheFileName($term, $amount))) {
            return $fee;
        }

        if (!is_array($feeBounds = $this->getFeeBounds($term, $amount))) {
            $this->writeCache($feeBounds, $cacheFile);

            return $feeBounds;
        }

        $fee = $this->interpolateFeeLinearly($amount, $feeBounds);
        $total = $this->roundUpToAny($fee + $amount);
        $fee = round($total - $amount, 2);
        $this->writeCache($fee, $cacheFile);

        return $fee;
    }

    /**
     * Checks if the calculation is cached already & returns it
     *
     * @param string $cacheFile
     *
     * @return false|float
     */
    private function getCache(string $cacheFile)
    {
        return file_exists($cacheFile) && time() - 18000 < filemtime($cacheFile) ? file_get_contents($cacheFile) : false;
    }

    /**
     * Get the cache file name
     *
     * @param int   $term
     * @param float $amount
     *
     * @return string
     */
    private function getCacheFileName(int $term, float $amount)
    : string {
        $cwd = getcwd();
        $paths = explode('\\', $cwd);
        $path = '';

        foreach ($paths as $item) {
            if ('fee-calculator' != $item) {
                $path .= ($path ? '/' : '') . $item;
                continue;
            }

            $path .= "/$item";
            break;
        }

        return "$path/public/cache/cached_files/cached-$term-" . str_replace('.', '-', $amount) . '.txt';
    }

    /**
     * Writes the fee to a cache file
     *
     * @param float  $fee
     * @param string $cacheFile
     */
    private function writeCache(float $fee, string $cacheFile)
    {
        file_put_contents($cacheFile, $fee);
    }
}