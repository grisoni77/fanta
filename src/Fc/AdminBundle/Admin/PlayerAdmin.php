<?php

namespace Fc\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use Fc\FantaBundle\Entity\Player;
use Fc\FantaBundle\Entity\Club;

/**
 * Sonata Club Admin class
 *
 * @author cris
 */
class PlayerAdmin extends Admin
{
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('role', 'sonata_model_type', array('label'=>'Ruolo'))
            ->add('currentClub', 'sonata_model_type', array('label' => 'Club'))
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
            ->add('name')
            ->add('role')
        ;
    }
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
                ->add('name')
                ->add('currentClub')
                ->add('signings', 'sonata_model_type', array('associated_tostring'=>'toStringPlayer'))
        ;
    }    
    
    protected function _configureRoutes(RouteCollection $collection)
    {
        //$collection->remove('edit');
    }
    
}

?>
