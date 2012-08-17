<?php

namespace Fc\SiteBundle\Wizard;

use Fc\SiteBundle\Wizard\AbstractCompetitionStep;
use Peytz\Wizard\ReportInterface;

/**
 * Description of CompetitionStep1
 *
 * @author cris
 */
class CompetitionStep3 extends AbstractCompetitionStep
{
    public function getForm($data, $options) {
        $builder = $this->competition_factory->getCompetitionBuilder($data->getType());
        return $builder->createForm($data, $options);
    }
    
    public function getName() {
        return 'step3';
    }
    
    /**
     * @return Boolean
     */
    public function isVisible(ReportInterface $report)
    {
        $type = $report->getType();
        $teams = $report->getTeams();
        return !empty($type) && !empty($teams);
    }    
}

?>