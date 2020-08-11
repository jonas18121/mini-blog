<?php

declare(strict_types=1);

namespace App\Tests\Func;

use App\Tests\Func\AbstractEndPoint;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends AbstractEndPoint
{
    private $userPayload = '{ "email": "%s", "password": "%s" }';

    public function testGetUsers() : void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_GET, 
            '/api/users',
            '',
            []
        );

        dd($response);

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent); // est ce que $responseContent est de type json
        self::assertNotEmpty($responseDecoded); // est ce que $responseContent n'est pas vide
    } 

    // public function testPostUser() : void
    // {
    //     $response = $this->getResponseFromRequest(
    //         Request::METHOD_POST, 
    //         '/api/users',
    //         $this->getPayload(),
    //         [],
    //         false 
    //     );

    //     $responseContent = $response->getContent();
    //     $responseDecoded = json_decode($responseContent);
    //     //dd($responseDecoded);

    //     self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    //     self::assertJson($responseContent); // est ce que $responseContent est de type json
    //     self::assertNotEmpty($responseDecoded); // est ce que $responseContent n'est pas vide
    // } 

    // public function testPutUser() : void
    // {
    //     $response = $this->getResponseFromRequest(
    //         Request::METHOD_PUT, 
    //         '/api/users/49',
    //         $this->getPayload(),
    //         []
    //     );

    //     $responseContent = $response->getContent();
    //     $responseDecoded = json_decode($responseContent);
    //     //dump($responseDecoded);

    //     self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    //     self::assertJson($responseContent); // est ce que $responseContent est de type json
    //     self::assertNotEmpty($responseDecoded); // est ce que $responseContent n'est pas vide
    // }

    // public function testDeleteUser() : void
    // {
    //     $response = $this->getResponseFromRequest(
    //         Request::METHOD_DELETE, 
    //         '/api/users/44'
    //     );

    //     self::assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    // } 

    public function testGetOneUser() : void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_GET, 
            '/api/users/51',
            '',
            [],
            false
        );

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);
        //dd($response);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent); // est ce que $responseContent est de type json
        // self::assertNotEmpty($responseDecoded); // est ce que $responseContent n'est pas vide
    }

    public function testGetDefaultUser() : int
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_GET, 
            '/api/users',
            '',
            ['email' => 'chienneTou@test.fr'],
            false
        );
        
        //dd($response);

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent, true);

        // dd($responseDecoded[0]['id']);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent); // est ce que $responseContent est de type json
        self::assertNotEmpty($responseDecoded); // est ce que $responseContent n'est pas vide

        return $responseDecoded[0]['id'];
    }

    private function getPayload() : string
    {
        $faker = Factory::create();

        return sprintf($this->userPayload, $faker->email(), $faker->password()); 
    }
}