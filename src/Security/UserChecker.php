<?php
namespace App\Security;

use DateTime;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class UserChecker implements UserCheckerInterface
{
    /**
     * @param User $user
     */
    public function checkPreAuth(UserInterface $user): void
    {
        if ($user->getBannedUntil() === null) {
            return;
        }

        $now = new DateTime();
        if ($now < $user->getBannedUntil()) {
            throw new CustomUserMessageAuthenticationException('The user is banned');
        }
    }

    /**
     * @param User $user
     */
    public function checkPostAuth(UserInterface $user /* , ?TokenInterface $token = null */): void
    {

    }
}