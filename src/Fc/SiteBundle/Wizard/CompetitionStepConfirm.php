<?php

namespace Fc\SiteBundle\Wizard;

use Fc\SiteBundle\Wizard\AbstractCompetitionStep;
use Peytz\Wizard\ReportInterface;

/**
 * Description of CompetitionStep1
 *
 * @author cris
 */
class CompetitionStepConfirm extends AbstractCompetitionStep
{
    public function getForm($report = null, $options = array()) {
        $builder = $this->competition_factory->getFormFactory()->createBuilder('form', $report, $options);
        return $builder->getForm();
    }
    
    public function getName() {
        return 'confirm';
    }
    
    /**
     * @return Boolean
     */
    public function isVisible(ReportInterface $report)
    {
        return $report->canCalculateResult();
    }    
    
    public function getDescriptionTemplate(ReportInterface $report) {
        return $this->competition_factory->getCompetitionBuilder($report->getType())->getConcreteDescriptionTemplate();
    }
}

?>