<?php

declare(strict_types=1);

namespace App\Events;

use App\Factory\JsonResponseInterface;
use App\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use App\Services\ExceptionNormalizerFormatterInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private static array $normalizers;
    private SerializerInterface $serializer;
    private ExceptionNormalizerFormatterInterface $exceptionNormalizerFormatter;
    private JsonResponseInterface $jsonResponseInterface;

    public function __construct(
        SerializerInterface $serializer,
        ExceptionNormalizerFormatterInterface $exceptionNormalizerFormatter,
        JsonResponseInterface $jsonResponseInterface
    )
    {
        $this->serializer = $serializer;  
        $this->exceptionNormalizerFormatter = $exceptionNormalizerFormatter;  
        $this->jsonResponseInterface = $jsonResponseInterface;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [[ 'processException', 0 ]]
        ];
    }

    public function processException(ExceptionEvent $event)
    {
        $result = null;

        /** @var \Exception $exception */
        $exception = $event->getThrowable();

        /** @var NormalizerInterface $normalizer */
        foreach(self::$normalizers as $key => $normalizer)
        {
            if($normalizer->supports($exception))
            {
                $result = $normalizer->normalize($exception);
                break;
            }
        }

        if(null === $result)
        {
            $result = $this->exceptionNormalizerFormatter->format(
                $exception->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }

        $body = $this->serializer->serialize($result, 'json');
        $response = $this->jsonResponseInterface->getJsonResponse($result['code'], $body);
        $event->setResponse($response);
    }

    public function addNormalizer(NormalizerInterface $normalizer)
    {
        self::$normalizers[] = $normalizer;
    }
}