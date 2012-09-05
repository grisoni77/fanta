<?php

namespace Fc\FantaBundle\Market;

use Fc\FantaBundle\Entity\Operation;
use Fc\FantaBundle\Entity\Transaction;
use Fc\FantaBundle\Entity\Listing;

/**
 * Description of OperationBuilder
 *
 * @author 71537
 */
class OperationBuilder 
{
    private $em = null;

    public function setEntityManager(\Doctrine\ORM\EntityManager $em) {
        $this->em = $em;
    }
    
    public function buyPlayer($data) 
    {
        if (!$this->em) {
            return false;
        }
        $em = $this->em;
        
        // find team
        print_r($data);
        $team = $em->getRepository('FcFantaBundle:Team')->find($data['team']);
        // build related entities
        $operation = new Operation();
        $operation->setTeam($team);
        $operation->setType('buy');
        $operation->setName($data['name']);
        $operation->setDescription($data['description']);
        $em->persist($operation);
        // find day
        $day = $em->getRepository('FcFantaBundle:Day')->find($data['day']);
        // find player
        $player = $em->getRepository('FcFantaBundle:Player')->find($data['player']);
        // find type
        $type = $em->getRepository('FcFantaBundle:TransactionType')->findOneBy(array(
            'name' => 'in'
        ));        
        // set transaction
        $transaction = new Transaction();
        $transaction->setOperation($operation);
        $transaction->setDay($day);
        $transaction->setTeam($team);
        $transaction->setPlayer($player);
        $transaction->setValue($data['value']);
        $transaction->setType($type);
        $em->persist($transaction);
        // set Listing
        $listing = new Listing();
        $listing->setPlayer($player);
        $listing->setRole($player->getRole());
        $listing->setTeam($team);
        $listing->setTransaction($transaction);
        $listing->setEnabled(true);
        $em->persist($listing);        
        
        $em->flush();
        
        return true;
    }
}

?>