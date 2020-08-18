<?php

declare(strict_types=1);

namespace App\Events;

use App\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExceptionListener implements EventSubscriberInterface
{
    private static array $normalizers;
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;   
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [[ 'processException', 0 ]]
        ];
    }

    public function processException(ExceptionEvent $event)
    {
        
    }

    public function addNormalizer(NormalizerInterface $normalizer)
    {
        self::$normalizers[] = $normalizer;
    }
}