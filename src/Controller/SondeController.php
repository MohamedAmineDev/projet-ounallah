<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SondeController extends AbstractController
{
    /**
     * @Route("/sonde", name="sonde")
     */
    public function index(): Response
    {
        return $this->render('sonde/index.html.twig', [
            'controller_name' => 'SondeController',
        ]);
    }

    /**
     * @Route("/utilisateur/inscription",name="addsonde")
     */
    public function addAdmin(UserPasswordEncoderInterface $encoder,Request $req){

        $admin=new User();
        $form = $this->createForm(UserType::class, $admin);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($admin, $admin->getPassword());
            $manager = $this->getDoctrine()->getManager();
            $admin->setRoles(["Sonde"]);
            $admin->setPassword($encoded);
            $manager->persist($admin);
            $manager->flush();
            return $this->redirectToRoute('accueil');
        }
            return $this->render('sonde/inscription.html.twig', [
                'form' => $form->createView()
                
            ]);
    }
    

    /**
     * @Route("/accueilSonde", name="accueilsonde")
     */
    public function accueilSonde(): Response
    {
        return $this->render('sonde/accueil_sonde.html.twig');
    }


     /**
     * @Route("/", name="accueil")
     */
    public function accueil(): Response
    {
        return $this->render('accueil.html.twig');
    }


    /**
 * @Route("update/sonde",name="updateutilisateur")
 */
public function updateUtilisateur(Request $req,UserPasswordEncoderInterface $encoder){
    $user=$this->getUser();
    $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('sondage_index');
        }
        

        return $this->render('sonde/edit.html.twig', [
            'utilisateur' => $user,
            'form' => $form->createView(),
        ]);
    }


}
