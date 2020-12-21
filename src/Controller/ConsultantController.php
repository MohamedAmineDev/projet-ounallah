<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultantController extends AbstractController
{
    /**
     * @Route("/consultant", name="consultant")
     */
    public function index(): Response
    {
        return $this->render('consultant/index.html.twig', [
            'controller_name' => 'ConsultantController',
        ]);
    }
}
