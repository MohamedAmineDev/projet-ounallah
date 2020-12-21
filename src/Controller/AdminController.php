<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\AdminType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * @Route("/inscriptionAdmin",name="addAdmin")
     */
    public function addAdmin(UserPasswordEncoderInterface $encoder,Request $req){

        $admin=new User();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($admin, $admin->getPassword());
            $manager = $this->getDoctrine()->getManager();
            $admin->setRoles(["Admin"]);
            $admin->setPassword($encoded);
            $manager->persist($admin);
            $manager->flush();
        }
            return $this->render('admin/inscription.html.twig', [
                'form' => $form->createView()
                
            ]);
    }

}
