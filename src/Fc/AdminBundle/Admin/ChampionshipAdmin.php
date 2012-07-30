<?php

namespace Fc\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use Fc\FantaBundle\Entity\Championship;


/**
 * Description of SeasonAdmin
 *
 * @author cris
 */
class ChampionshipAdmin extends Admin 
{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('enabled')
            ->add('name')
            ->add('season', 'sonata_type_model')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('enabled', 'sonata_type_boolean', array('required' => false, 'expanded' => false))
                ->add('name')
                ->add('season', 'sonata_type_model', array('expanded' => true, 'compound' => true))
            ->end()
            ->with('Clubs')
                //->add('clubs', 'sonata_type_model')
            ->end()
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('season', 'sonata_type_model')
            ->add('enabled')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'import' => array('template' => 'FcAdminBundle:ChampionshipAdmin:list__action_import.html.twig'),
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
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
            ->add('season')
            ->add('enabled')
        ;
    }
    
    
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('import', 'import-players');
    }    
    
    /**
     * {@inheritdoc}
    protected function configureSideMenu(MenuItemInterface $menu, $action, Admin $childAdmin = null)
    {
        $admin = $this->isChild() ? $this->getParent() : $this;

        if ($action=="list")
        {
            $menu->addChild(
                $this->trans('Importa giocatori'),
                array('uri' => $admin->generateUrl('import'))
            );
        }
    }    
    
    public function getListTemplate()
    {
        return 'FcAdminBundle:ChampionshipAdmin:list.html.twig';
    }
     */

}

?>
