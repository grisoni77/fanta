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
        //print_r($data);
        //$this->context->addViolation($constraint->message, array('%string%' => $value));
    }
}

?>