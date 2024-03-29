<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
         $user = new User();
        $user->setUsername('admin')
             ->setPassword($this->encoder->encodePassword($user, 'admin'))
             ->setPhone('380939789961')
             ->setEmail('romanrimskiy@gmail.com');
        $manager->persist($user);

        $manager->flush();
    }

}
