<?php

declare(strict_types=1);

namespace App\Normalizer;

use App\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\Response;

class RessourceAccessExceptionNormalizer implements AbstractNormalizer
{
    public function normalize(\Exception $exception) : array
    {
       $result['code'] = Response::HTTP_UNAUTHORIZED ; 

       $result['body'] = [
            'code' => $result['code'],
            'message' => $exception->getMessage()
       ];

       return $result;
    }
}