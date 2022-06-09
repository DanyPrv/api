<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\HardwareRequest;
use App\Entity\User;
use App\Repository\HardwareRequestRepository;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

final class HardwareRequestItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private HardwareRequestRepository $repository,
        private Security $security,
    ){}

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return HardwareRequest::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        $user = $this->security->getUser();
        if(!($user instanceof  User)) {
            throw new AccessDeniedException('No access');
        }

        $record = $this->repository->find($id);
        if(!in_array('ROLE_ADMIN',$user->getRoles()) && $record?->getOwner()?->getId() !== $user->getId()) {
            throw new AccessDeniedException('No access');
        }

        return $record;
    }
}
