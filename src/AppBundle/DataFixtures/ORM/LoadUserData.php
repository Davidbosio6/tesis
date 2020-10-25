<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadUserData extends AbstractFixture implements FixtureInterface
{
    const USER_1 = 'u_user1';
    const USER_2 = 'u_user2';
    const USER_3 = 'u_user3';
    const USER_4 = 'u_user4';
    const USER_5 = 'u_user5';
    const USER_6 = 'u_user6';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('dbosio');
        $user->setEmail("dbosio@noemail.com");
        $user->setPassword('$2y$13$dGZXgjzOqmLdoiriiLNOte5prVlnSghTrJSr962dCz6Q8RC91TDQe');
        $user->setIsActive(true);
        $manager->persist($user);
        $this->addReference(self::USER_1, $user);

        $user = new User();
        $user->setUsername('lgrant');
        $user->setEmail("lgant@noemail.com");
        $user->setPassword('$2y$13$dGZXgjzOqmLdoiriiLNOte5prVlnSghTrJSr962dCz6Q8RC91TDQe');
        $user->setIsActive(true);
        $manager->persist($user);
        $this->addReference(self::USER_2, $user);

        $user = new User();
        $user->setUsername('ssmith');
        $user->setEmail("ssmith@noemail.com");
        $user->setPassword('$2y$13$dGZXgjzOqmLdoiriiLNOte5prVlnSghTrJSr962dCz6Q8RC91TDQe');
        $user->setIsActive(true);
        $manager->persist($user);
        $this->addReference(self::USER_3, $user);

        $user = new User();
        $user->setUsername('alevine');
        $user->setEmail("alevine@noemail.com");
        $user->setPassword('$2y$13$dGZXgjzOqmLdoiriiLNOte5prVlnSghTrJSr962dCz6Q8RC91TDQe');
        $user->setIsActive(true);
        $manager->persist($user);
        $this->addReference(self::USER_4, $user);

        $user = new User();
        $user->setUsername('dfernandez');
        $user->setEmail("dfernandez@noemail.com");
        $user->setPassword('$2y$13$dGZXgjzOqmLdoiriiLNOte5prVlnSghTrJSr962dCz6Q8RC91TDQe');
        $user->setIsActive(true);
        $manager->persist($user);
        $this->addReference(self::USER_5, $user);

        $user = new User();
        $user->setUsername('sgomez');
        $user->setEmail("sgomez@noemail.com");
        $user->setPassword('$2y$13$dGZXgjzOqmLdoiriiLNOte5prVlnSghTrJSr962dCz6Q8RC91TDQe');
        $user->setIsActive(true);
        $manager->persist($user);
        $this->addReference(self::USER_6, $user);

        $manager->flush();
    }
}
