<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CadeauType ;
use App\Form\NewRemunerationType ;
use App\Form\RemiseType ;
use App\Entity\Cadeau;
use App\Entity\Remise;
use App\Entity\Sondage;
use App\Entity\NouveauType;
use App\Repository\RemunerationRepository;
use App\Repository\SondageRepository;



class RemunerationController extends AbstractController
{

    private $em;
    public function __construct ( EntityManagerInterface $em){
        $this->em=$em;
    }
    

    public function index(): Response
    {
        return $this->render('Remuneration/ChoixRemun.html.twig', [
            'controller_name' => 'RemunerationController',
        ]);
    }
     /**
     * @Route("/ChoixRemun/{idSondage}", name="ChoixRemun")
     */
      public function ChoixRemun($idSondage, Request $request ,  SondageRepository $sondageRepository){
       
   
    
            $cadeau=new Cadeau();
            $sondage = new Sondage();
            $sondage=$sondageRepository->find($idSondage);
            $form= $this->createForm(CadeauType::class, $cadeau);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()){
                $cadeau->setSondage($sondage);
                $this->em->persist($cadeau);
                $this->em->flush();
                //return $this->redirectToRoute("ChoixRemun", ['idSondage'=> $idSondage]);
                return $this->redirectToRoute("choixEnqueteurSondage",['sondage'=>$sondage->getId()]);
            }
               
            $remise=new Remise();
            $form1= $this->createForm(RemiseType::class, $remise);
            $form1->handleRequest($request);
         
            if ($form1->isSubmitted() && $form1->isValid()){
                $remise->setSondage($sondage);
                $this->em->persist($remise);
                $this->em->flush();
                return $this->redirectToRoute("choixEnqueteurSondage",['sondage'=>$sondage->getId()]);
            }
            return $this->render('Remuneration/ChoixRemun.html.twig',[
                'remise'=>$remise,
                'cadeau'=>$cadeau,
                'idSondage' => $idSondage,
                'form1'=>$form1->createView(),
                'form'=>$form->createView()
                    
                ]);
            }
    /**
     * @Route("/AjoutRemun/{idEnqueteur}/{idSondage} ", name="AjoutRemun")
     */
        public function AddRemun($idEnqueteur, $idSondage,Request $request , SondageRepository $sondageRepository){
                   
                $remun=new NouveauType();
                $sondage = new Sondage();
                $sondage=$sondageRepository->find($idSondage);
                $form= $this->createForm(NewRemunerationType::class, $remun);
                $form->handleRequest($request);
             
                if ($form->isSubmitted() && $form->isValid()){
                   $remun->setSondage($sondage);
                   $this->em->persist($remun);
                   $this->em->flush();
                   return $this->redirectToRoute("sondage_index", ['idEnqueteur'=> $idEnqueteur ]);
                }
                return $this->render('Remuneration/AjoutRemun.html.twig',[
                    'remuneration'=>$remun,
                    'form'=>$form->createView()]);
                }
                      
                
        }
