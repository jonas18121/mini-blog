<?php

declare(strict_types=1);

namespace App\Normalizer;

use App\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\Response;

class AuthentificationExceptionNormalizer extends AbstractNormalizer
{
    // public function normalize(\Exception $exception) : array
    // {
    //    $result['code'] = Response::HTTP_UNAUTHORIZED ; 

    //    $result['body'] = [
    //         'code' => $result['code'],
    //         'message' => $exception->getMessage()
    //    ];

    //    return $result;
    // }

    public function normalize(\Exception $exception) : array
    {
        return $this->exceptionNormalizerFormatter->format(
           $exception->getMessage(),
           Response::HTTP_UNAUTHORIZED
        );
    }
}