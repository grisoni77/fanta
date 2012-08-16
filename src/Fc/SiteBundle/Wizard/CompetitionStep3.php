<?php

namespace Fc\SiteBundle\Wizard;

use Peytz\Wizard\Step as Step;
use Fc\SiteBundle\Form\CompetitionFormType;
use Fc\FantaBundle\Competition\CompetitionFactory;

/**
 * Description of CompetitionStep1
 *
 * @author cris
 */
class CompetitionStep3 extends Step
{
    /**
     * @var \Fc\FantaBundle\Competition\CompetitionFactory
     */
    private $competition_factory;
    
    public function __construct(\Fc\FantaBundle\Competition\CompetitionFactory $factory) {
        $this->competition_factory = $factory;
    }


    public function getFormType() {
        return new CompetitionFormType($this->competition_factory);
    }
    public function getForm($data, $options) {
        $builder = $this->competition_factory->getCompetitionBuilder($data->getType());
        return $builder->createForm($data, $options);
    }
    
    public function getName() {
        return 'step3';
    }
}

?>