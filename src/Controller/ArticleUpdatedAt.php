<?php

namespace App\Controller;

use App\Entity\Article;

/**
 * ArticleUpdatedAt est un custom Controller (custom Operation),
 * les données renvoyer vers ArticleUpdatedAt seront nommée $data par convention.
 *
 * __invoke() ce déclenche tout seul lorsqu'on appel la class ArticleUpdatedAt dans
 * la custom operation avec put_updated_at qui est dans itemOperation de l'entité Article
 */
class ArticleUpdatedAt
{
    public function __invoke(Article $data): Article
    {
        $data->setUpdatedAt(new \DateTimeImmutable('tomorrow'));

        return $data;
    }
}
