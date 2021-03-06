<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

trait Timestapable
{
    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user_read","user_details_read", "article_details_read", "article_read"})
     */
    private \DateTimeInterface $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"user_read","user_details_read", "article_details_read", "article_read"})
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * Get the value of createdAt.
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of updatedAt.
     *
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt.
     *
     * @param \DateTimeInterface $updatedAt
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
