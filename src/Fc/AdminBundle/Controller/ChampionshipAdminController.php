<?php

namespace Fc\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;

use Fc\FantaBundle\Entity\Championship;
use Fc\FantaBundle\Entity\Player;
use Fc\FantaBundle\Entity\Club;
use Fc\FantaBundle\Entity\Day;
use Fc\FantaBundle\Entity\Signing;
use Fc\FantaBundle\Entity\Mark;

/**
 * Description of SeasonAdminController
 *
 * @author cris
 */
class ChampionshipAdminController extends Controller {

    /**
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function importPlayersAction(Request $request)
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
        
        return $this->render('FcAdminBundle:ChampionshipAdmin:import_players.html.twig', array(
            'action'   => 'import_players',
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
        $daRepo = $em->getRepository('FcFantaBundle:Day');
        //$siRepo = $em->getRepository('FcFantaBundle:Signing');
        
        // cerca giornata zero e se non la trova la crea
        $day = $daRepo->findOneBy(array('championship'=>$champ, 'number' => 0));
        if (!$day) {
            $day = new Day();
            $day->setChampionship($champ);
            $day->setNumber(0);
            $day->setDate(new \DateTime());
            $em->persist($day);
        }
        
        
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
                $player = $plRepo->findOneBy(array('code' => $data[0]));
                if (!$player) 
                {
                    $player = new Player();
                    $player->setCode($data[0]);
                    $player->setName(trim($data[2], '"'));
                    $player->setQuotation(trim($data[27], '"'));
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
                    //$player->addClub($clubs[$clubName]);
                    // look for role
                    $role = $roRepo->findOneBy(array('code' => $data[5]));
                    $player->setRole($role);
                    $em->persist($player);
                    // aggiorna giornata di riferimento in signing
                    $signing = new Signing();
                    $signing->setDay($day);
                    $signing->setPlayer($player);
                    $signing->setClub($clubs[$clubName]);
                    $player->setCurrentClub($clubs[$clubName]);
                    $em->persist($signing);
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
        //$builder = $em->createQueryBuilder();
        // remove old days
        $qd = $em->createQuery('delete from FcFantaBundle:Day d where d.number > 0 AND d.championship = :champ')
                ->setParameter('champ', $champ);
        if (false === $qd->execute()) {
            //throw new \Doctrine\ORM\Query\QueryException('ciupa'.$qd->getSQL());
            return false;
        }
        
        // genera giornata zero (prima dell'inizio, serve per inizializzazione giocatori)
        // se non esiste già
        $daRepo = $em->getRepository('FcFantaBundle:Day');
        $day = $daRepo->findOneBy(array('championship'=>$champ, 'number' => 0));
        if (!$day) {
            $day = new Day();
            $day->setChampionship($champ);
            $day->setNumber(0);
            $day->setDate(new \DateTime());
            $em->persist($day);
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
        return true;
    }
    
    
    /**
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function importMarksAction(Request $request)
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
                if (!$this->_importMarks($champ, $form['file']->getData())) {
                    $msg = 'Importazione andata male...il file è corretto?';
                } else {
                    //print_r($form['file']);die();
                    $msg = 'Importazione conclusa correttamente';
                }
            } else {
                $msg = 'Form non valido';
            }
        }
        
        return $this->render('FcAdminBundle:ChampionshipAdmin:import_marks.html.twig', array(
            'action'   => 'import_marks',
            'form'     => $form->createView(),
            'id'       => $id,
            'champ'    => $champ,
            'msg'      => isset($msg) ? $msg : ''
        ));
    }
    
    protected function _importMarks(Championship $champ, \Symfony\Component\HttpFoundation\File\UploadedFile $uploadedFile)
    {
        $em = $this->getDoctrine()->getEntityManager();
        //$chRepo = $em->getRepository('FcFantaBundle:Championship');
        $plRepo = $em->getRepository('FcFantaBundle:Player');
        $clRepo = $em->getRepository('FcFantaBundle:Club');
        $roRepo = $em->getRepository('FcFantaBundle:Role');
        $daRepo = $em->getRepository('FcFantaBundle:Day');
        //$siRepo = $em->getRepository('FcFantaBundle:Signing');
        $maRepo = $em->getRepository('FcFantaBundle:Mark');
        
        $file = $uploadedFile->openFile();
        $clubs = array();
        while (!$file->eof()) {
            //var_dump($file->fgets());
            $s = $file->fgets();
            //echo $s;
            //var_dump(explode('|', $s));
            $data = explode('|', $s);
            //print_r($data);
            if (isset($data[2]))
            {
                // cerca giornata
                $day = $daRepo->findOneBy(array('championship'=>$champ, 'number' => $data[1]));
                // look for club in repo
                $clubName = trim($data[3], '"');
                if (!isset($clubs[$clubName])) {
                    $clubs[$clubName] = $clRepo->findOneBy(array('name' => $clubName));
                }
                // look for player in repo
                $player = $plRepo->findOneBy(array('code' => $data[0]));
                //print_r($player->getName());die();
                if (!$player) 
                {
                    $player = new Player();
                    $player->setCode($data[0]);
                    $player->setName(trim($data[2], '"'));
                    $player->setQuotation(trim($data[27], '"'));
                    $role = $roRepo->findOneBy(array('code' => $data[5]));
                    $player->setRole($role);
                    // aggiorna giornata di riferimento in signing
                    $signing = new Signing();
                    $signing->setDay($day);
                    $signing->setPlayer($player);
                    $signing->setClub($clubs[$clubName]);
                    $player->setCurrentClub($clubs[$clubName]);
                    $em->persist($signing);                    
                } else {
                    // controlla che non ci sia già il voto e se c'è passa al successivo
                    $mark = $maRepo->findOneBy(array('player'=>$player, 'day' => $day));
                    if ($mark) {
                        continue;
                    }
                }
                
                // se club diverso effettua trasferimento 
                // @TODO usare funzione tipo equals ???
                //if ($player->getCurrentClub()->getId() !== $clubs[$clubName]->getId()) {
                //echo $s.$player->getName();
                if (!$player->isCurrentClub($clubs[$clubName])) {
                    // aggiorna giornata di riferimento in signing
                    $signing = new Signing();
                    $signing->setDay($day);
                    $signing->setPlayer($player);
                    $signing->setClub($clubs[$clubName]);
                    $player->setCurrentClub($clubs[$clubName]);
                    $em->persist($signing);                    
                }
                
                // aggiunge voto
                /* Codice|giornata|COGNOME nome|Squadra|Trasferito|Ruolo|Presenza|Voto Fc
                * |Minuti inferiore 25|Minuti superiore 25|Voto giornale|Gol segnati
                * |Gol subiti|Gol vittoria|Gol pareggio|Assist|Ammonizione|Espulsione
                * |Rigore tirato|Rigore subito|Rigore parato|Rigore sbagliato|Autogol
                * |Entrato a partita iniziata|Titolare|SV|Gioca in casa|Valore crediti
                */      
                $mark = new Mark();
                $mark->setDay($day);
                $mark->setPlayer($player);
                $mark->setTrasferito($data[4]);
                $mark->setPresenza($data[6]);
                $mark->setVotoFc($data[7]);
                $mark->setMinInf25($data[8]);
                $mark->setMinSup25($data[9]);
                $mark->setVotoGazzetta($data[10]);
                $mark->setGoalSegnati($data[11]);
                $mark->setGoalSubiti($data[12]);
                $mark->setGoalVittoria($data[13]);
                $mark->setGoalPareggio($data[14]);
                $mark->setAssist($data[15]);
                $mark->setAmmonizione($data[16]);
                $mark->setEspulsione($data[17]);
                $mark->setRigoriTirati($data[18]);
                $mark->setRigoriSubiti($data[19]);
                $mark->setRigoriParati($data[20]);
                $mark->setRigoriSbagliati($data[21]);
                $mark->setAutogoal($data[22]);
                $mark->setSubentrato($data[23]);
                $mark->setTitolare($data[24]);
                $mark->setSenzaVoto($data[25]);
                $mark->setGiocaInCasa($data[26]);
                $mark->setValoreCrediti($data[27]);
                $em->persist($mark);
                
                // set player new quotation
                $player->setQuotation($mark->getValoreCrediti());
                $em->persist($player);
            }
        }
        // go
        $em->flush();
        return true;
        //die();
    } 
    
}
