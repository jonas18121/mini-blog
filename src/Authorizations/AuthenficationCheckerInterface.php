<?php

declare(strict_types=1);

namespace App\Authorizations;

interface AuthenficationCheckerInterface
{
    const MESSAGE_ERROR = 'You are not authenticated';

    public function isAuthenticated(): void;

    public function isMethodAllowed(string $method): bool;

    public function check($object, string $method): void;
}
