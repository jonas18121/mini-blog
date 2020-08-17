<?php

declare(strict_types=1);

namespace App\Authorizations;

use App\Authorizations\AuthenficationCheckerInterface;

class AuthentificationChecker implements AuthenficationCheckerInterface
{
    public function isAuthenticated(): void
    {

    }

    public function isMethodAllowed(string $method): bool
    {

    }

    public function check($object, string $method): void
    {
        
    }
}