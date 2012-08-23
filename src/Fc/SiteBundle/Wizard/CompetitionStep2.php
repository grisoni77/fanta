<?php

namespace Fc\SiteBundle\Wizard;

use Fc\SiteBundle\Wizard\AbstractCompetitionStep;
use Peytz\Wizard\ReportInterface;

/**
 * Description of CompetitionStep1
 *
 * @author cris
 */
class CompetitionStep2 extends AbstractCompetitionStep
{
    public function getForm($data = null, $options = array()) {
        $builder = $this->competition_factory->getFormFactory()->createBuilder('form', $data, $options);
        $teams = $this->competition_factory->getLeagueTeams($data->getLeague());
        $choices = array();
        foreach ($teams as $t) {
            $choices[$t->getId()] = $t->getName();
        }
        $builder->add('teams', 'choice', array(
            'choices' => $choices,
            'multiple'=> true,
            'expanded'=> false,
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