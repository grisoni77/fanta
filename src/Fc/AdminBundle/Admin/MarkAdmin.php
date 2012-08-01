<?php

namespace Fc\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use Fc\FantaBundle\Entity\Player;
use Fc\FantaBundle\Entity\Day;

/**
 * Sonata Club Admin class
 *
 * @author cris
 */
class MarkAdmin extends Admin
{
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('id')
                ->add('day', 'sonata_model_type', array('label'=>'Giornata'))
                ->add('player', 'sonata_model_type', array('label'=>'Giocatore'))
                ->add('votoFC')
                ->add('votoGazzetta')
                ->add('valoreCrediti', null, array('label'=>'Quotazione'))
            
            //->add('club.championship', 'sonata_model_type', array('label' => 'Campionato'))
            //->add('championship.season', 'sonata_type_model', array('label'=>'Stagione'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    //'edit' => array(),
                    //'delete' => array(),
                )
            ))
        ;
    }
    
    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('player')
            ->add('day')
        ;
    }
    
}

?>
