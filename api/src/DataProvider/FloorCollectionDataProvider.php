<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Floor;
use App\Iterators\ArrayPaginatorEditable;
use App\Repository\FloorRepository;

final class FloorCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private FloorRepository $repository){}

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Floor::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $records = $this->repository->findAll();
        return new ArrayPaginatorEditable($records, 0, count($records), count($records));

    }
}
