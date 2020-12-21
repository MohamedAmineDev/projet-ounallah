<?php

namespace App\Controller;

use App\Entity\Sondage;
use App\Entity\Cadeau;
use App\Entity\Question;
use App\Entity\Remise;
use App\Entity\NouveauType;
use App\Form\SondageType;
use App\Repository\SondageRepository;
use App\Repository\SujetRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Paiement;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/sondage")
 */
class SondageController extends AbstractController
{

/**
     * @Route("/paiementConsulting/{sondage}",name="paiementConsulting")
     */
    public function payer(Request $req,Sondage $sondage){
        if($req->request->count()>0){
            $date=$req->request->get('expiration');
            $manager=$this->getDoctrine()->getManager();
            $paiment=new Paiement();
            $paiment->setNomCarte($req->request->get('nomCarte'))
            ->setNumCarte($req->request->get('numCarte'))
            ->setExpiration( new \DateTime (" ".$date))
            ->setUser($this->getUser())
            ->setCvv($req->request->get('cvv'));
            $manager->persist($paiment);
            $sondage->setMisEnLigne();
            $manager->persist($sondage);
            //$this->getDoctrine()->getManager()->flush();
            $manager->flush();
            return $this->redirectToRoute("sondage_index",['idEnqueteur'=>$this->getUser()->getId()]);
        }
        return $this->render("paiement\paiementSondage.html.twig",['sondage'=>$sondage]);
    }


    /**
     * @Route("/questionPaiement/{sondage}",name="choixEnqueteurSondage")
     */
    public function choixEnqueteurSondage(Sondage $sondage){
        return $this->render("paiement/questionPaiement.html.twig",['sondage'=>$sondage]);
    }

   
 /**
     * @Route("/sondages/{idSonde}",name="listesondage",methods="GET")
     */
    public function getSondages($idSonde){
        $repo=$this->getDoctrine()->getRepository(Sondage::class);
        $sondages=$repo->findAll();
        
        
        foreach($sondages as $son)
        {    
            $em1=$this->getDoctrine()->getManager();
            $NbrSondage =count($em1->getRepository(Question::class)->findByNbrSondage($son->getId()));
            $son->setNbQuestion($NbrSondage );
             
            $em1->flush();
        }
 
        return $this->render('sondage/liste_sondage.html.twig',[
            'sondages'=>$sondages,
            'id'=>$idSonde,
            
            
        ]);
    }


    /**
     * @Route("/{idEnqueteur}", name="sondage_index", methods={"GET"})
     */
    public function index($idEnqueteur,SondageRepository $sondageRepository): Response
    {
        $sondages=$sondageRepository->findByIdEnqueteur($idEnqueteur);
        $sondagesNOnVisible=[];
        $l=count($sondages);
        $i=0;
        while($i<$l){
            if($sondages[$i]->getMisEnLigne()==0){
                array_push ($sondagesNOnVisible,$sondages[$i]);
            }
            $i++;
        }

        foreach($sondagesNOnVisible as $son)
        {    
            $em1=$this->getDoctrine()->getManager();
            $NbrQuestion =count($em1->getRepository(Question::class)->findByNbrSondage($son->getId()));
            $son->setNbQuestion($NbrQuestion);
            $em1->flush();
        }
        
        return $this->render('sondage/index.html.twig', [
            'sondages' => $sondagesNOnVisible,
            'idEnqueteur'=>$idEnqueteur
            ]);
    }
    
   

    /**
     * @Route("/new/{idEnqueteur}/{idSujet}", name="sondage_new", methods={"GET","POST"})
     */
    public function new($idEnqueteur, $idSujet,Request $request,SujetRepository $sujetRepository,UserRepository $enqueteurRepository): Response
    {
        $sondage = new Sondage();
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);
        $sujet=$sujetRepository->find($idSujet);
        $enqueteur=$enqueteurRepository->find($idEnqueteur);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $sondage->setSujet($sujet);
            $sondage->setEnqueteur($enqueteur);
            $sondage->setMisEnLigne(0);
            $entityManager->persist($sondage);
            $entityManager->flush();

            return $this->redirectToRoute('consulting',['idSondage'=>$sondage->getId() , 
                                                        'idEnqueteur'=>$idEnqueteur ]);
        }

        return $this->render('sondage/new.html.twig', [
            'sondage' => $sondage,
            'idEnqueteur'=>$idEnqueteur,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/{idEnqueteur}", name="sondage_show", methods={"GET"})
     */
    public function show($idEnqueteur,Sondage $sondage): Response
    {
        return $this->render('sondage/show.html.twig', [
            'sondage' => $sondage,
            'idEnqueteur'=>$idEnqueteur
        ]);
    }

    /**
     * @Route("/{id}/edit/{idEnqueteur}", name="sondage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sondage $sondage, $idEnqueteur): Response
    {
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sondage_index',
                                            ['idEnqueteur'=> $idEnqueteur]);
        }

        return $this->render('sondage/edit.html.twig', [
            'sondage' => $sondage,
            'form' => $form->createView(),
            'idEnqueteur'=>$idEnqueteur
        ]);
    }

    /**
     * @Route("/{id}/{idEnqueteur}", name="sondage_delete", methods={"DELETE"})
     */
    public function delete($idEnqueteur,Request $request, Sondage $sondage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sondage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sondage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sondage_index',
                                      ['idEnqueteur'=> $idEnqueteur]);
    }
    /**
     * @Route("/sondagee/{id}",name="sondagee")
     * @param $id
     */
    public function getQuestion($id,SondageRepository $sondageRepository){

            $sondage=$sondageRepository->find($id);
            dd($sondage);

    }


    /**
     * @Route("consulting/{idEnqueteur}/{idSondage}", name="consulting", methods={"GET"})
     */
    public function consulting($idEnqueteur, $idSondage): Response
    {
        return $this->render('consulting/index.html.twig',['idSondage'=>$idSondage,
                                                            'idEnqueteur'=> $idEnqueteur]);
    }


    
}
