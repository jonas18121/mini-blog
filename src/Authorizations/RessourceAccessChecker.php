<?php

declare(strict_types=1);

namespace App\Authorizations;

use App\Exceptions\RessourceAccessException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class RessourceAccessChecker implements RessourceAccessCheckerInterface
{
    /** @var UserInterface */
    private ?UserInterface $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function canAccess(?int $id): void
    {
        if ($this->user->getId() !== $id) {
            throw new RessourceAccessException(Response::HTTP_UNAUTHORIZED, self::MESSAGE_ERROR);
        }
    }
}
