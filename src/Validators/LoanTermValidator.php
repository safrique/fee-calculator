<?php

namespace Lendable\Interview\Interpolation\Validators;

class LoanTermValidator
{
    /**
     * Returns available loan terms
     *
     * @return int[]
     */
    public static function getAvailableTerms()
    : array
    {
        return [12, 24];
    }

    /**
     * Validates the term
     *
     * @param int $term
     *
     * @return bool
     */
    public static function validateTerm(int $term)
    : bool {
        return in_array($term, self::getAvailableTerms());
    }
}