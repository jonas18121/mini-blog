<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

trait RessourceId
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user_read","user_details_read", "article_details_read", "article_read"})
     */
    private int $id; // hinting ecrit comme ça est possible depuis php 7.4 

    
    public function getId(): ?int
    {
        return $this->id;
    }
}