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
    public function getForm($data, $options) {
        $builder = $this->competition_factory->getCompetitionBuilder($data->getType());
        return $builder->createForm($data, $options);
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
}

?>