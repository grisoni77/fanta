<?php

namespace Fc\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;

use Fc\FantaBundle\Entity\Championship;
use Fc\FantaBundle\Entity\Player;
use Fc\FantaBundle\Entity\Club;
use Fc\FantaBundle\Entity\Day;

/**
 * Description of SeasonAdminController
 *
 * @author cris
 */
class ChampionshipAdminController extends Controller {

    /**
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function importAction(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getEntityManager();
        $champ = $em->getRepository('FcFantaBundle:Championship')->find($id);
        if (!$champ) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Campionato inesistente');
        }
        
        $builder = $this->createFormBuilder();
        $builder
            ->add('file', 'file')
        ;
        $form = $builder->getForm();
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            
            if ($form->isValid()) {
                if (!$this->_importPlayers($champ, $form['file']->getData())) {
                    $msg = 'Importazione andata male...il file è corretto?';
                } else {
                    //print_r($form['file']);die();
                    $msg = 'Importazione conclusa correttamente';
                }
            } else {
                $msg = 'Form non valido';
            }
        }
        
        return $this->render('FcAdminBundle:ChampionshipAdmin:import.html.twig', array(
            'action'   => 'import',
            'form'     => $form->createView(),
            'id'       => $id,
            'champ'    => $champ,
            'msg'      => isset($msg) ? $msg : ''
        ));
    }
    
    protected function _importPlayers(Championship $champ, \Symfony\Component\HttpFoundation\File\UploadedFile $uploadedFile)
    {
        $em = $this->getDoctrine()->getEntityManager();
        //$chRepo = $em->getRepository('FcFantaBundle:Championship');
        $plRepo = $em->getRepository('FcFantaBundle:Player');
        $clRepo = $em->getRepository('FcFantaBundle:Club');
        $roRepo = $em->getRepository('FcFantaBundle:Role');
        
        //print_r($file->openFile());
        //print_r($file->getClientOriginalName());die();
        $file = $uploadedFile->openFile();
        $clubs = array();
        while (!$file->eof()) {
            //var_dump($file->fgets());
            $s = $file->fgets();
            //var_dump(explode('|', $s));
            $data = explode('|', $s);
            if (isset($data[2]))
            {
                // look for player in repo
                $player = $plRepo->findByCode($data[0]);
                if (!$player) 
                {
                    $player = new Player();
                    $player->setCode($data[0]);
                    $player->setName(trim($data[2], '"'));
                    // look for player in repo
                    $clubName = trim($data[3], '"');
                    if (!isset($clubs[$clubName])) {
                        $clubs[$clubName] = $clRepo->findOneBy(array('name' => $clubName));
                        if (!$clubs[$clubName])
                        {
                            $clubs[$clubName] = new Club();
                            $clubs[$clubName]->setName($clubName);
                            $clubs[$clubName]->setChampionship($champ);
                            $em->persist($clubs[$clubName]);
                        }
                    }
                    $player->addClub($clubs[$clubName]);
                    // look for role
                    $role = $roRepo->findOneBy(array('code' => $data[5]));
                    $player->setRole($role);
                    $em->persist($player);
                    //die();
                }
            }
        }
        // go
        $em->flush();
        return true;
        //die();
    } 
    
    /**
     * Inizializza calendario (crea solo record fittizi in tabella days) 
     */
    public function initCalendarAction(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getEntityManager();
        $champ = $em->getRepository('FcFantaBundle:Championship')->find($id);
        if (!$champ) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Campionato inesistente');
        }
        
        $builder = $this->createFormBuilder();
        $builder
            ->add('num_giornate', 'integer', array('label'=>'# giornate per girone'))
            ->add('num_gironi', 'integer', array('label'=>'# gironi'))
        ;
        $form = $builder->getForm();
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            
            if ($form->isValid()) {
                if (!$this->_generateCalendar($champ, $form->getData())) {
                    $msg = 'Importazione andata male...il file è corretto?';
                } else {
                    //print_r($form['file']);die();
                    $msg = 'Importazione conclusa correttamente';
                }
            } else {
                $msg = 'Form non valido';
            }
        }
        
        return $this->render('FcAdminBundle:ChampionshipAdmin:init_calendar.html.twig', array(
            'action'   => 'init_calendar',
            'form'     => $form->createView(),
            'id'       => $id,
            'champ'    => $champ,
            'msg'      => isset($msg) ? $msg : ''
        ));        
    }
    
    protected function _generateCalendar($champ, $data)
    {
        // get manager
        $em = $this->getDoctrine()->getEntityManager();
        $builder = $em->createQueryBuilder();
        // remove old days
        $qd = $em->createQuery('delete from FcFantaBundle:Day d where d.championship = :champ')
                ->setParameter('champ', $champ);
        if (!$qd->execute()) {
            throw new ErrorException('ciupa'.$qd);
        }
        
        for ($g=0; $g<$data['num_gironi']; $g++)
        {
            for ($d=1; $d<=$data['num_giornate']; $d++)
            {
                $day = new Day();
                $day->setChampionship($champ);
                $day->setNumber($g*$data['num_giornate']+$d);
                $day->setDate(new \DateTime());
                $em->persist($day);
            }
        }
        
        $em->flush();
    }
}
