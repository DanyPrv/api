<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Resource;
use App\Entity\User;
use App\Iterators\ArrayPaginatorEditable;
use App\Repository\ResourceRepository;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

final class ResourceCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private ResourceRepository $repository,
        private Security $security,
    ){}

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        //used only by standard users
        $user = $this->security->getUser();
        if(!($user instanceof  User) || in_array('ROLE_ADMIN',$user->getRoles())) {
            return false;
        }

        return Resource::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $user = $this->security->getUser();
        if(!($user instanceof  User)) {
            throw new AccessDeniedException('No access');
        }
        $records = $this->repository->findByUserField($user->getId());

        return new ArrayPaginatorEditable($records, 0, count($records), count($records));
    }
}
