<?php

namespace Fc\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Sonata Club Admin class
 *
 * @author cris
 */
class MarkAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
                ->add('day', 'sonata_type_model')
                ->add('player', 'sonata_type_model')
                ->add('votoFc', null, array('label'=>'Voto Fantacalcio'))
                ->add('votoGazzetta', null, array('label'=>'Voto Gazzetta'))
                ->add('ammonizione')
                ->add('espulsione')
                ->add('assist')
                ->add('goalSegnati')
                ->add('goalSubiti')
                ->add('rigoriTirati')
                ->add('rigoriSbagliati')
                ->add('rigoriParati')
                ->add('autogoal')
                ->add('presenza')
                ->add('titolare')
                ->add('subentrato')
                ->add('minInf25', null, array('label'=>'Giocati più di 25m'))
                ->add('minSup25', null, array('label'=>'Giocati meno di 25m'))
                ->add('valoreCrediti', null, array('label'=>'Quotazione'))
        ;
    }    
    
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('id')
                ->add('day', 'sonata_model_type', array('label'=>'Giornata'))
                ->add('player', 'sonata_model_type', array('label'=>'Giocatore'))
                ->add('votoFc', null, array('label'=>'Voto Fantacalcio'))
                ->add('votoGazzetta', null, array('label'=>'Voto Gazzetta'))
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
 
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('edit');
    }    
    
}

?>
