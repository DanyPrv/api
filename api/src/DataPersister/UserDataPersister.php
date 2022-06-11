<?php

namespace App\DataPersister;

use App\Repository\UserRepository;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Throwable;

class UserDataPersister implements DataPersisterInterface
{
    private User $loggedUser;
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordEncoder,
        Security $security,
    ){
        $loggedUser = $security->getUser();
        if($loggedUser instanceof User) {
            $this->loggedUser = $loggedUser;
        } else {
            throw new AccessDeniedException('Access denied');
        }
    }

    public function supports($data): bool
    {
        return $data instanceof User;
    }

    /**
     * @param User $data
     */
    public function persist($data)
    {
        if(in_array('ROLE_ADMIN',$this->loggedUser->getRoles())) {
            $this->adminPersist($data);
        } else {
            if($this->loggedUser->getId() !== $data->getId()){
                throw new AccessDeniedException('Access denied');
            }
            $this->standardUserPersist($data);
        }
    }

    private function adminPersist(User $data) {
        $plainPassword = null;
        try {
            $plainPassword = $data->getPlainPassword();
        } catch (Throwable){

        }
        if ($plainPassword !== null) {
            if($this->loggedUser->getId() === $data->getId()) {
                //if password is changed for itself check for oldPass
                if(!$this->userPasswordEncoder->isPasswordValid($this->loggedUser, $data->getOldPassword())) {
                    throw new AccessDeniedException('Invalid input');
                }
            }
            $data->setPassword(
                $this->userPasswordEncoder->hashPassword($data, $plainPassword)
            );
            $data->eraseCredentials();
        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    private function standardUserPersist(User $data){
        //retrieve the user and check if old password is the same as the one stored
        if(null === $data->getOldPassword()|| null === $data->getPlainPassword()) {
            throw new Exception('Invalid input');
        }
        $user = $this->userRepository->find($data->getId());
        if(!$this->userPasswordEncoder->isPasswordValid($user, $data->getOldPassword())) {
            throw new AccessDeniedException('Invalid input');
        }
        $user->setPassword(
            $this->userPasswordEncoder->hashPassword($user, $data->getPlainPassword())
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
