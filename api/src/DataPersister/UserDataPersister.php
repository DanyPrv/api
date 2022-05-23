<?php

namespace App\DataPersister;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class UserDataPersister implements DataPersisterInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordEncoder
    ){}

    public function supports($data): bool
    {
        return $data instanceof User;
    }

    /**
     * @param User $data
     */
    public function persist($data)
    {
        $plainPassword = null;
        try {
            $plainPassword = $data->getPlainPassword();
        } catch (\Throwable $e){

        };
        if ($plainPassword !== null) {
            $data->setPassword(
                $this->userPasswordEncoder->hashPassword($data, $plainPassword)
            );
            $data->eraseCredentials();
        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
