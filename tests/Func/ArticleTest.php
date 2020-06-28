<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\Tests\Func;

use App\Tests\Func\AbstractEndPoint;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleTest extends AbstractEndPoint
{
    public function testGetArticles() : void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_GET, 
            '/api/articles'
        );

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        //dd($responseContent);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent); // est ce que $responseContent est de type json
        self::assertNotEmpty($responseDecoded); // est ce que $responseContent n'est pas vide
    }
}