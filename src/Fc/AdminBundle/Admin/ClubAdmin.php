<?php

namespace Fc\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use Fc\FantaBundle\Entity\Club;

/**
 * Sonata Club Admin class
 *
 * @author cris
 */
class ClubAdmin extends Admin
{
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('championship', 'sonata_model_type', array('label'=>'Campionato'))
            //->add('championship.season', 'sonata_type_model', array('label'=>'Stagione'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
    
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
                ->add('name')
                ->add('championship')
                ->add('currentPlayers')
        ;
    }
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('edit');
    }     
}

?>
