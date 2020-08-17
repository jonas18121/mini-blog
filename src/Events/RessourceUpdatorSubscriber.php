<?php

declare(strict_types=1);

namespace App\Events;

use App\Entity\User;
use App\Services\RessourceUpdatorInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Article;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RessourceUpdatorSubscriber implements EventSubscriberInterface
{
    private RessourceUpdatorInterface $ressourceUpdator;

    public function __construct(RessourceUpdatorInterface $ressourceUpdator)
    {
        $this->ressourceUpdator = $ressourceUpdator;
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
        $object = $event->getControllerResult();

        if($object instanceof User || $object instanceof Article)
        {
            $user = $object instanceof User ? $object : $object->getAuthor();

            $canProcess = $this->ressourceUpdator->process($event->getRequest()->getMethod(), $user);

            if($canProcess)
            {
                $object->setUpdatedAt(new \DateTimeImmutable());
            }
        }
    }
}