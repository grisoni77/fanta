<?php

namespace Fc\SiteBundle\Wizard;

use Peytz\Wizard\Step as Step;
use Fc\SiteBundle\Form\CompetitionFormType;
use Fc\FantaBundle\Competition\CompetitionFactory;
use Peytz\Wizard\ReportInterface;

/**
 * Description of CompetitionStep1
 *
 * @author cris
 */
class CompetitionStep2 extends Step
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
        $builder = $this->competition_factory->getFormFactory()->createBuilder('form', $data, $options);
        $teams = $this->competition_factory->getLeagueTeams($data->getLeague());
        $choices = array();
        foreach ($teams as $t) {
            $choices[$t->getId()] = $t->getName();
        }
        $builder->add('teams', 'choice', array(
            'choices' => $choices,
            'multiple'=> true,
            'expanded'=> true,
        ));
        return $builder->getForm();

    }
    
    public function getName() {
        return 'step2';
    }
    
    /**
     * @return Boolean
     */
    public function isVisible(ReportInterface $report)
    {
        $type = $report->getType();
        return !empty($type);
    }
}

?>