<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->article = new Article();
    }

    public function testGetName(): void
    {
        $value = "mon nom d'article";

        $response = $this->article->setName($value);
        $getName = $this->article->getName();

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($value, $getName);
    }

    public function testGetContent(): void
    {
        $value = 'mon contenu de test';

        $response = $this->article->setContent($value);
        $getContent = $this->article->getContent();

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($value, $getContent);
    }

    public function testGetAuthor(): void
    {
        $value = new User();

        $response = $this->article->setAuthor($value);
        $getAuthor = $this->article->getAuthor();

        self::assertInstanceOf(Article::class, $response);
        self::assertInstanceOf(User::class, $getAuthor);
    }
}
