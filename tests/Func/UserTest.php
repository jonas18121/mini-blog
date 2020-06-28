<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\tests\Func;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends AbstractEndPoint
{
    public function testGetUsers() : void
    {
        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/users');
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent); // est ce que $responseContent est de type json
        self::assertNotEmpty($responseContent); // est ce que $responseContent est vide
    } 
}