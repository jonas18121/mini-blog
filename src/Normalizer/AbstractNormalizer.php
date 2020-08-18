<?php

declare(strict_types=1);

namespace App\Normalizer;

use App\Normalizer\NormalizerInterface;

class AbstractNormalizer implements NormalizerInterface
{
    private array $exceptionTypes;

    public function __construct(array $exceptionTypes)
    {
        $this->exceptionTypes = $exceptionTypes;
    }

    public function supports(\Exception $exception) : bool
    {
        
    }
}