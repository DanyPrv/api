<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\HardwareRequest;
use App\Entity\User;
use App\Iterators\ArrayPaginatorEditable;
use App\Repository\HardwareRequestRepository;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

final class HardwareRequestCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private HardwareRequestRepository $repository,
        private Security $security,
    ){}

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return HardwareRequest::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $user = $this->security->getUser();
        if(!($user instanceof  User)) {
            throw new AccessDeniedException('No access');
        }
        $records = [];
        if(in_array('ROLE_ADMIN',$user->getRoles())) {
            $records = $this->repository->findAll();
        } else {
            $records = $this->repository->findByUserField($user->getId());
        }

        return new ArrayPaginatorEditable($records, 0, count($records), count($records));

    }
}
