<?php

declare(strict_types=1);

namespace App\Events;

use App\Entity\User;
use App\Authorizations\UserAuthorizationChecker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserSubscriber implements EventSubscriberInterface
{
    private array $methodNotAllowed = [
        Request::METHOD_POST,
        Request::METHOD_GET
    ];

    private UserAuthorizationChecker $userAuthorizationChecker;

    public function __construct(UserAuthorizationChecker $userAuthorizationChecker)
    {
        $this->userAuthorizationChecker = $userAuthorizationChecker;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['check', EventPriorities::PRE_WRITE]
        ];
    }

    /**
     * 
     *
     * @param ViewEvent $event
     * @return void
     */
    public function check(ViewEvent $event) : void
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if($user instanceof User && !in_array($method, $this->methodNotAllowed, true))
        {
            $this->userAuthorizationChecker->checker($user, $method);
            $user->setUpdatedAt(new \DateTimeImmutable());
        }
    }
}