<?php
namespace Fc\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fc\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
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
        
        $userManager->updateUser($user);
        
        $manager->persist($user);
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
}