<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\HardwareRequest;
use App\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class HardwareRequestDataPersister implements ContextAwareDataPersisterInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private Security $security
    ){}

    public function supports($data, $context = []): bool
    {
        return $data instanceof HardwareRequest;
    }

    /**
     * @param HardwareRequest $data
     */
    public function persist($data, $context = [])
    {
        /** @var HardwareRequest|null $previousData */
        $previousData = $context['previous_data'] ?? null;

        $resource = null;
        $user = $this->security->getUser();
        if(!($user instanceof User)){
            throw new AccessDeniedException('Invalid rights');
        }
        if(!in_array('ROLE_ADMIN',$user->getRoles())) {

            //STANDARD USER
            $data->setStatus($previousData?->getStatus() ?? 'NEW');
            $data->setOwner($user);
        } else if(null === $data->getOwner()){
            $data->setOwner($user);
        }
        if(null === $data->getStatus()) {
            $data->setStatus('NEW');
        }
        if('APPROVED' === $data->getStatus()) {
            $resource = new Resource();
            $resource->setOwner($data->getOwner());
            $resource->setName($data->getName());
            $resource->setHardwareRequest($data);
        }

        $this->entityManager->persist($data);
        if(null !== $resource) {
            $this->entityManager->persist($resource);
        }
        $this->entityManager->flush();
    }

    public function remove($data, $context = [])
    {}
}
