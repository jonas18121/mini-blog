<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\Entity;

trait RessourceId
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id; // hinting ecrit comme ça est possible depuis php 7.4 

    
    public function getId(): ?int
    {
        return $this->id;
    }
}