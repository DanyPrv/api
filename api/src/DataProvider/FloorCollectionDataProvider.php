<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Floor;
use App\Repository\FloorRepository;
use Doctrine\Common\Collections\ArrayCollection;

final class FloorCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private FloorRepository $repository){}

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Floor::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        return new ArrayCollection($this->repository->findAll());
    }
}
