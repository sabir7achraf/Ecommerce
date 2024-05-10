<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Command\UserPasswordHashCommand;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(Private UserPasswordHasherInterface $hasher){}
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $admin=new User();
        $admin-> setEmail("admin@admin.com");
        $admin2=new User();
        $admin2-> setEmail("admin2@admin.com");
        $admin->setPassword($this->hasher->hashPassword($admin,"admin"));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin2->setPassword($this->hasher->hashPassword( $admin,"admin1"));
        $admin2->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->persist($admin2);
        for($i=1;$i<=5;$i++){
            $user=new User();
            $user->setEmail("user$i@user.com");
            $user->setPassword($this->hasher->hashPassword( $user,"user$i"));
            $manager->persist($user);
        }
        $manager->flush();

    }
}
