<?php

declare(strict_types=1);

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class AuthenticationSuccessListener
{
    public function __construct(
        private SerializerInterface $serializer
    ) {
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $data = $event->getData();

        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }
        $publicUserData = $this->serializer->serialize(
                $user,
                'json',
                ['groups' => 'login:output']
            );
        $data['user'] = json_decode($publicUserData, true);
        $event->setData($data);
    }

}
