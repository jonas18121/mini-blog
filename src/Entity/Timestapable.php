<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\Entity;

trait Timestapable
{
    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $updateAt;


    /**
     * Get the value of createdAt
     *
     * @return  \DateTimeInterface
     */ 
    public function getCreatedAt(): \DateTimeInterface 
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param  \DateTimeInterface  $createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of updateAt
     *
     * @return  \DateTimeInterface
     */ 
    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    /**
     * Set the value of updateAt
     *
     * @param  \DateTimeInterface  $updateAt
     *
     * @return  self
     */ 
    public function setUpdateAt(?\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}