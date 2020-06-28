<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\tests\Func;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

Abstract class AbstractEndPoint extends WebTestCase
{
    private array $serverInformation = [
        'ACCEPT' => 'application/json',
        'CONTENT_TYPE' => 'application/json'
    ];

    public function getResponseFromRequest(string $method, string $uri, string $payload = '') : Response
    {
        $client = self::createClient();

        $client->request(
            $method, 
            $uri . '.json',
            [],
            [],
            $this->serverInformation,
            $payload
        );

        return $client->getResponse();
    } 
}