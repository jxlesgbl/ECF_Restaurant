<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserAdminFixtures extends Fixture
{
    /** @var EntityManagerInterface $em */
    protected $em;

    /** @var UserPasswordHasherInterface $userPasswordHasher */
    protected $userPasswordHasher;

    /**
     * @param UserManager $userManager
     * @param UserPasswordHasherInterface $userPasswordHasher
     */
    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->em = $em;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $user->setEmail('jules.gribal@gmail.com');
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                'jules'
            )
        );
        $user->setFirstname('jules');
        $user->setLastname('gribal');
        $user->setPhoneNumber('0652010396');

        $this->em->persist($user);
        $this->em->flush();
    }
}