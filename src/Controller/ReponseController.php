<?php

namespace App\Controller;

use App\Entity\Sondage;
use App\Entity\Option;
use App\Entity\Question;
use App\Entity\Reponse;
use App\Entity\User;
use App\Form\SondageType;
use App\Repository\SondageRepository;
use App\Repository\ReponseRepository;
use App\Repository\QuestionRepository;
use App\Repository\SujetRepository;
use App\Repository\EnqueteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Reponse")
 */
class ReponseController extends AbstractController
{
    /**
     * @Route("/Repondre/{idSondage} ",name="repondre",methods="GET")
     */
    public function Repondre( $idSondage){
        $repo1=$this->getDoctrine()->getRepository(Question::class);
        $Questions=$repo1->findByNbrSondage($idSondage);
        
        
        foreach($Questions as $question)
        {    
            $repo2=$this->getDoctrine()->getRepository(Option::class);
            $Options=$repo2->findByIdQuestion($question->getId());
        }
 
        return $this->render('sondage/repondre.html.twig',[
            'Questions'=>$Questions,
            'Options'=>$Options,
            'idSondage'=>$idSondage
        ]);
    }
/**
     * @Route("/Repondre/{id}/{idSondage} ",name="RecupererReponse",methods="POST")
     */
    public function RecupererReponse($id, $idSondage){
        $repo1=$this->getDoctrine()->getRepository(Question::class);        
        $Questions=$repo1->findByNbrSondage($idSondage);        
        $repo2=$this->getDoctrine()->getRepository(User::class);    
       

        
         
        foreach($Questions as $question)
        {  
            $reponse=new Reponse();
            $entityManager = $this->getDoctrine()->getManager();
            $reponse->setQuestion($question);
            $reponse->setUser($repo2->find($id));
            $reponse->setText($_POST[$question->getId()]);
            $entityManager->persist($reponse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('listesondage',[ 'idSonde'=>$id]);
       /* return $this->render('accueil.html.twig',
                            [ 'id'=>$id,                                        
                            'post'=>$tab,                                        
                            'idSondage'=>$idSondage]);*/
        
        
    }


    


}
