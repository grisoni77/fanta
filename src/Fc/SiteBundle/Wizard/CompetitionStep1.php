<?php

namespace Fc\SiteBundle\Wizard;

use Fc\SiteBundle\Wizard\AbstractCompetitionStep;
use Peytz\Wizard\ReportInterface;
use Fc\FantaBundle\Form\DataTransformer\LeagueToNumberTransformer;

/**
 * Description of CompetitionStep1
 *
 * @author cris
 */
class CompetitionStep1 extends AbstractCompetitionStep
{
    public function getForm($data = null, $options = array()) {
        $builder = $this->competition_factory->getFormFactory()->createBuilder('form', $data, $options);
        $types = $this->competition_factory->getCompetitionTypes();
        $choices = array();
        foreach ($types as $t) {
            $choices[$t['name']] = $t['label'];
        }
        $builder    
            ->add('name', null, array(
                'label' => 'Nome competizione'
            ))
            ->add('type', 'choice', array(
                'label' => 'Tipo competizione',
                'choices' => $choices
            ))
        ;
        return $builder->getForm();
    }
    
    public function getName() {
        return 'step1';
    }
    
    /**
     * @return Boolean
     */
    public function isVisible(ReportInterface $report)
    {
        return true;
    }
    
}

?>