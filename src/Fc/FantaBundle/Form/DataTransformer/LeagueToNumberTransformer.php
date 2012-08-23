<?php

namespace Fc\FantaBundle\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Fc\FantaBundle\Entity\League;
use Doctrine\ORM\EntityManager;

/**
 * Description of LeagueToNumberTransformer
 *
 * @author cris
 */
class LeagueToNumberTransformer implements DataTransformerInterface
{
    private $em;
    
    public function __construct(EntityManager $manager) {
        $this->em = $manager;
    }
    
    public function reverseTransform($id) {
        return $em->getRepository('FcFantaBundle:League')->find($id);
    }
    
    public function transform($league) {
        return $league->getId();
    }
}

?>