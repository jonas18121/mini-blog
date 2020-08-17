<?php

declare(strict_types=1);

namespace App\Authorizations;


use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserAuthorizationChecker implements Authorization
{
    private array $methodAllowed = [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE
    ];

    private ?UserInterface $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function checker(UserInterface $user, string $method) : void
    {
        $this->isAuthenticated();

        if($this->isMethodAllowed($method) && $user->getId() !== $this->user->getId()){
            $errorMessage = 'It\'s not your ressource ';
            throw new UnauthorizedHttpException($errorMessage, $errorMessage);
        }
    }

    public function isAuthenticated() : void
    {
        if(null === $this->user){
            $errorMessage = 'You are not authoticated';
            throw new UnauthorizedHttpException($errorMessage, $errorMessage);
        }
    }

    /**
     * vérifie si la methode entrer fais partie des méthodes authoriser
     *
     * @param string $method
     * @return boolean
     */
    public function isMethodAllowed(string $method) : bool
    {
        return in_array($method, $this->methodAllowed, true);
    }
}