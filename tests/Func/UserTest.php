<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\Tests\Func;

use App\Tests\Func\AbstractEndPoint;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends AbstractEndPoint
{
    private $userPayload = '{ "email": "%s", "password": "password" }';

    public function testGetUsers() : void
    {
        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/users');
        
        //dd($response);

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent); // est ce que $responseContent est de type json
        self::assertNotEmpty($responseContent); // est ce que $responseContent n'est pas vide
    } 

    public function testPostUser() : void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_POST, 
            '/api/users',
            $this->getPayload()
        );

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);
        //dd($responseDecoded);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertJson($responseContent); // est ce que $responseContent est de type json
        self::assertNotEmpty($responseContent); // est ce que $responseContent n'est pas vide
    } 

    private function getPayload()
    {
        $faker = Factory::create();

        return sprintf($this->userPayload, $faker->email());
    }
}