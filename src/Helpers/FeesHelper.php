<?php

namespace Lendable\Interview\Interpolation\Helpers;

trait FeesHelper
{
    /**
     * Returns the combination of loan amount vs fee by term
     *
     * @param int $term
     *
     * @return int[][]
     */
    private function getFeeListByTerm(int $term)
    : array {
        if ($term == 12) {
            return [
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
        }

        return [
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
    }

    /**
     * Returns the fee on the lowest available amount if loan equals that or lower & upper bounds of where the loan
     * amount falls between the fee breakpoints
     *
     * @param int   $term
     * @param float $amount
     *
     * @return int|int[][]|void
     */
    private function getFeeBounds(int $term, float $amount)
    {
        $termFees = $this->getFeeListByTerm($term);

        if ($amount == $termFees[0]['amount']) {
            return $termFees[0]['fee'];
        }

        for ($i = 1, $len = count($termFees); $i < $len; $i++) {
            if ($amount <= $termFees[$i]['amount']) {
                return [$termFees[$i - 1], $termFees[$i]];
            }
        }
    }
}