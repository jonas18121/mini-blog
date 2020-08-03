<?php

declare(strict_types=1);

namespace App\Events;

use App\Entity\User;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncoderSubscriber implements EventSubscriberInterface
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE]
        ];
    }

    /**
     * hash le mot de passe , lorsqu'on s'inscrit en mode API
     *
     * @param ViewEvent $event
     * @return void
     */
    public function encodePassword(ViewEvent $event) : void
    {
        $user = $event->getControllerResult();

        if($user instanceof User){
            $passHash = $this->encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($passHash);
        }
    }
}