<?php

declare(strict_types=1);

namespace App\Services;

use App\Authorizations\AuthenficationCheckerInterface;
use App\Authorizations\RessourceAccessCheckerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class RessourceUpdator implements RessourceUpdatorInterface
{
    protected array $methodAllowed = [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE,
    ];

    /** @var RessourceAccessCheckerInterface */
    private RessourceAccessCheckerInterface $ressourceAccessChecker;

    /** @var AuthenficationCheckerInterface */
    private AuthenficationCheckerInterface $authenficationChecker;

    public function __construct(
        RessourceAccessCheckerInterface $ressourceAccessChecker,
        AuthenficationCheckerInterface $authenficationChecker
    ) {
        $this->ressourceAccessChecker = $ressourceAccessChecker;
        $this->authenficationChecker = $authenficationChecker;
    }

    public function process(string $method, UserInterface $user): bool
    {
        if (in_array($method, $this->methodAllowed, true)) {
            $this->authenficationChecker->isAuthenticated();
            $this->ressourceAccessChecker->canAccess($user->getId());

            return true;
        }

        return false;
    }
}
