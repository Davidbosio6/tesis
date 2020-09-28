<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadUserData extends AbstractFixture implements FixtureInterface
{
    const ADMIN = 'u_admin';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail("admin@noemail.com");
        $user->setPassword('$2y$13$dGZXgjzOqmLdoiriiLNOte5prVlnSghTrJSr962dCz6Q8RC91TDQe');
        $user->setIsActive(true);
        $manager->persist($user);
        $this->addReference(self::ADMIN, $user);

        $manager->flush();
    }
}
