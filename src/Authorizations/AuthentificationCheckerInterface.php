<?php

declare(strict_types=1);

namespace App\Authorizations;

interface AuthentificationCheckerInterface
{
    public function isAuthentificated(): void;
}