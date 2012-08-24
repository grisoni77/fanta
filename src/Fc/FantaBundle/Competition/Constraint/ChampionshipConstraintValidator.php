<?php

namespace Fc\FantaBundle\Competition\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


/**
 * Description of ChampionshipConstraintValidator
 *
 * @author cris
 */
class ChampionshipConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        //print_r($value->getData());die();
        //echo $this->context->getGroup()->get('num_gironi')->value;
        $data = $this->context->getRoot()->getData();
        
        // calcola giornate totali
        $teams = count($data->getTeams());
        $num_gironi = $data->num_gironi;
        $gior_x_girone = $teams%2 === 0 ? $teams-1 : $teams;
        $necessarie = $gior_x_girone*$num_gironi;
        
        // check numero giornate
        $day_from = $data->day_from;
        $day_to = $data->day_to;
        if ($day_to->getNumber() - $day_from->getNumber() + 1 < $necessarie) {
            $this->context->addViolation(sprintf('Non ci sono abbastanza giornate per i parametri scelti: giornate disponibili = %d giornate scelte = %d ',
                    $day_to->getNumber() - $day_from->getNumber() + 1, $necessarie
            ), array('%string%' => $value));
        }
        
        //echo $day_from;
        //echo $day_to;
        //echo $data->getLeague()->getId();
        //print_r($data);
        //$this->context->addViolation($constraint->message, array('%string%' => $value));
    }
}

?>