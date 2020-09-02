<?php

declare(strict_types=1);

namespace App\Authorizations;

use App\Exceptions\AuthentificationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthentificationChecker implements AuthenficationCheckerInterface
{
    /** @var UserInterface */
    private ?UserInterface $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function isAuthenticated(): void
    {
        if (null === $this->user) {
            throw new AuthentificationException(Response::HTTP_UNAUTHORIZED, self::MESSAGE_ERROR);
        }
    }

    public function isMethodAllowed(string $method): bool
    {
    }

    public function check($object, string $method): void
    {
    }
}
