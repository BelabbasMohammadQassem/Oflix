<?php

namespace App\Utils;

use App\Entity\Review;
use App\Entity\Show;
use Doctrine\Common\Collections\Collection;

class ReviewHelper
{
    private $defaultRating;

    public function __construct($defaultRating)
    {
        $this->defaultRating = $defaultRating;
    }

    /**
     * Undocumented function
     *
     * @param Collection $reviewList
     * @return float
     */
    public function calculateRating(Collection $reviewList):float
    {
        // gérer les cas particulier dès le début pour simplifier le code
        if ($reviewList->count() === 0) return $this->defaultRating;

        $totalRating = 0;
        /** @var Review $currentReview */
        foreach ($reviewList as $currentReview )
        {
            $totalRating += $currentReview->getRating();
        }

        $finalRating = $totalRating / $reviewList->count();
        return round($finalRating, 1);
    }

    public function calculateRatingForShow(Show $show): float
    {
        return $this->calculateRating($show->getReviews());
    }
}