<?php

namespace Fc\SiteBundle\Wizard;

use Peytz\Wizard\Wizard;
use Peytz\Wizard\ReportInterface;

/**
 * Description of CompetitionWizard
 *
 * @author cris
 */
class CompetitionWizard extends Wizard
{
    private $competition_factory;
    
    public function __construct(ReportInterface $report, \Fc\FantaBundle\Competition\CompetitionFactory $factory)
    {
        parent::__construct($report);
        $this->competition_factory = $factory;
        //add steps
        $this->set(new CompetitionStep1($this->competition_factory)); 
        $this->set(new CompetitionStep2($this->competition_factory)); 
        $this->set(new CompetitionStep3($this->competition_factory)); 
        $this->set(new CompetitionStepConfirm($this->competition_factory));
    }
    
}

?>