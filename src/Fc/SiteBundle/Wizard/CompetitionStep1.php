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
class CompetitionStep1 extends Step
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
            ));
        ;
        return $builder->getForm();
    }
    
    public function getName() {
        return 'step1';
    }
    
    public function process(\Peytz\Wizard\ReportInterface $report)
    {
    }
}

?>