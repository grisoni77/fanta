<?php
namespace Fc\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fc\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        
        $user = $userManager->createUser();
        $user->setName('Cristiano');
        $user->setEmail('cristiano.cucco@gmail.com');
        $user->setUsername('admin');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->addRole('ROLE_USER');
        $user->addRole('ROLE_ADMIN');
        $user->addRole('ROLE_SUPER_ADMIN');
        $user->addRole('ROLE_SONATA_ADMIN');        
        $userManager->updateUser($user);
        $manager->persist($user);
        
        // altri utenti
        
        for ($i=1; $i<10 ; $i++) {
            $user = $userManager->createUser();
            $user->setName('User '.$i);
            $user->setEmail(sprintf('user%d@gmail.com', $i));
            $user->setUsername('user'.$i);
            $user->setPlainPassword('user');
            $user->setEnabled(true);
            $user->addRole('ROLE_USER');
            $userManager->updateUser($user);
            $manager->persist($user);
        }        
        
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    
    public function getOrder()
    {
        return 1; // ordine in cui le fixture saranno caricate
    }
}