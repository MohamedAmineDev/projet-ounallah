<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\SujetType;
use App\Entity\Sujet;
use App\Repository\SujetRepository;
/**
    * @Route("/sujet")
 */

class SujetController extends AbstractController
{
    private $s;
    private $em;
    public function __construct (SujetRepository $s, EntityManagerInterface $em){
        $this->s=$s;
        $this->em=$em;
    }
    /**
     * @Route("/sujet", name="sujet")
     */
    public function index(): Response
    {
        return $this->render('sujet/index.html.twig', [
            'controller_name' => 'SujetController',
        ]);
    }

    /**
     *  @Route("/new/{id}", name="ajouter_sujet")
     */
    public function add($id, Request $request){
        $sujet=new Sujet();
        $form= $this->createForm(SujetType::class, $sujet);
        $form->handleRequest($request);
        
 
        if ($form->isSubmitted() && $form->isValid()){
           $this->em->persist($sujet);
           $this->em->flush();
           return $this->redirectToRoute("sondage_new",['idSujet'=>$sujet->getId() ,'idEnqueteur'=>$id ]);
        }
        return $this->render('Sujet/AddSujet.html.twig',[
            'sujet'=>$sujet,
            'form'=>$form->createView()
        ]);
    }
}
