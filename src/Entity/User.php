<?php

// forcer les erreurs si on a pas bien typé nos class
declare(strict_types=1);

namespace App\Entity;

// use App\Entity\Article;
// use App\Entity\RessourceId;
// use App\Entity\Timestapable;
use App\Entity\{
    Article,
    RessourceId,
    Timestapable
};
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{
    SearchFilter,
    DateFilter,
    BooleanFilter,
    NumericFilter,
    RangeFilter,
    ExistsFilter,
    OrderFilter
};
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * video numero 11 stopper a 00:00
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * 
 * @ApiResource(
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"user_read"}}
 *          },
 *          "post"
 *      },
 *      itemOperations={
 *         "get"={
 *              "normalization_context"={"groups"={"user_details_read"}}
 *          }, 
 *          "put",
 *          "patch",
 *          "delete"
 *      }
 * )
 * @ApiFilter(SearchFilter::class, properties={"email": "partial"})
 * @ApiFilter(DateFilter::class, properties={"createdAt"})
 * @ApiFilter(BooleanFilter::class, properties={"status"})
 * @ApiFilter(NumericFilter::class, properties={"age"})
 * @ApiFilter(RangeFilter::class, properties={"age"})
 * @ApiFilter(ExistsFilter::class, properties={"updatedAt"})
 * @ApiFilter(OrderFilter::class, properties={"id"}, arguments={"orderParameterName"="order"})
 */
class User implements UserInterface
{
    use RessourceId;
    use Timestapable;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user_read","user_details_read", "article_details_read"})
     */
    private string $email;// hinting ecrit comme ça est possible depuis php 7.4 

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="author", orphanRemoval=true)
     * @Groups({"user_details_read"})
     */
    private Collection $articles;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user_read","user_details_read", "article_details_read"})
     */
    private bool $status;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user_read","user_details_read", "article_details_read"})
     */
    private int $age;

    public function __construct()
    {
        $this->articles     = new ArrayCollection();
        $this->createdAt    = new \DateTimeImmutable();
        $this->status       = true;
        $this->age          = 18;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setAuthor($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getAuthor() === $this) {
                $article->setAuthor(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
}
