<?php

namespace Fc\SiteBundle\Wizard;

use Peytz\Wizard\Step as WizStep;
use Fc\FantaBundle\Competition\CompetitionFactory;
use Peytz\Wizard\ReportInterface;

/**
 * Description of AbstractCompetitionStep
 *
 * @author cris
 */
abstract class AbstractCompetitionStep extends WizStep
{
    /**
     * @var \Fc\FantaBundle\Competition\CompetitionFactory
     */
    protected $competition_factory;
    
    public $visible = false;
    
    public function __construct(\Fc\FantaBundle\Competition\CompetitionFactory $factory) {
        $this->competition_factory = $factory;
    }
    
    public function getFormType() {
        return null;
    }

    public function process(ReportInterface $report)
    {
        // set visible
        $this->visible = $this->isVisible($report);
    }    
    
    public function getDescriptionTemplate(ReportInterface $report) {
        return 'FcSiteBundle:Competition:'.$this->getName().'.html.twig';
    }
}

?>