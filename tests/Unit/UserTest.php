<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\tests\Unit;

use App\Entity\User;
use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp() : void
    {
        parent::setUp();

        $this->user = new User();
    }

    public function testGetEmail() : void
    {
        $value = 'admin@gmail.com';

        $response       = $this->user->setEmail($value);
        $getEmail       = $this->user->getEmail();
        $getUsername    = $this->user->getUsername();

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $getEmail);
        self::assertEquals($value, $getUsername);
    }

    public function testGetRoles() : void
    {
        $value = ['ROLE_ADMIN'];
        $response = $this->user->setRoles($value);

        $getRoles = $this->user->getRoles();

        self::assertInstanceOf(User::class, $response);
        self::assertContains('ROLE_USER', $getRoles );// assertContains() pour les tableaux
        self::assertContains('ROLE_ADMIN', $getRoles );
    }

    public function testGetPassword() : void
    {
        $value = 'adminadmin';
        $response = $this->user->setPassword($value);

        $getPassword = $this->user->getPassword();

        self::assertInstanceOf(User::class, $response);
        self::assertContains($value, $getPassword );
    }

    public function testGetArticle() : void
    {
        $value = new Article();

        // ajouter un article
        $response = $this->user->addArticle($value);

        $getArticles = $this->user->getArticles();

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $getArticles ); // verifie le nombre d'article , ici compte s'il y a 1 article
        self::assertTrue($getArticles->contains($value)); // verifie si c'est vrai qu'il y a un article présent

        // supprimer un article
        // $response = $this->user->removeArticle($value);

        // self::assertInstanceOf(User::class, $response);
        // self::assertCount(0, $this->user->getArticles()); // verifie le nombre d'article , ici compte s'il y a 0 article
        // self::assertTrue($this->user->getArticles()->contains($value)); // verifie si c'est vrai qu'il n'y a pas d'article présent
    }

    public function testRemoveArticle() : void
    {
        $value = new Article(); 

        // supprimer un article
        $response = $this->user->removeArticle($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(0, $this->user->getArticles()); // verifie le nombre d'article , ici compte s'il y a 0 article
        self::assertFalse($this->user->getArticles()->contains($value)); // verifie si c'est vrai qu'il n'y a pas d'article présent
    }


}