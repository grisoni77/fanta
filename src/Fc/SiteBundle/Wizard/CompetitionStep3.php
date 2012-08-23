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
    public function getForm(ReportInterface $report = null, $options = array()) {
        $builder = $this->competition_factory->getCompetitionBuilder($report->getType());
        return $builder->createForm($report, $options);
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
    
    public function getDescriptionTemplate(ReportInterface $report)
    {
        return $this->competition_factory->getCompetitionBuilder($report->getType())->getDescriptionTemplate();
    }
}

?>