<?php

namespace App\Security\Voter;

use App\Entity\Review;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ReviewVoter extends Voter
{
    private $security;
    public const EDIT = 'REVIEW_EDIT';
    // public const VIEW = 'REVIEW_VIEW';

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    // isGranted('REVIEW_EDIT', $review)
    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        // dd($attribute);
        if (!in_array($attribute, [self::EDIT])) {
            return false;
        }

        // dump($subject);
        // only vote on `Review` objects
        if (!$subject instanceof Review) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $review, TokenInterface $token): bool
    {
        /** @var User $user */
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                if ($this->security->isGranted('ROLE_ADMIN')) 
                {
                    return true;
                }

                if ($user->getId() == $review->getUser()->getId()) 
                {
                    return true;
                }
                break;
        }

        return false;
    }
}
