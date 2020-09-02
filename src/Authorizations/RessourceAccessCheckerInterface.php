<?php

declare(strict_types=1);

namespace App\Authorizations;

interface RessourceAccessCheckerInterface
{
    const MESSAGE_ERROR = 'It\'s not your ressource ';

    public function canAccess(?int $id): void;
}
