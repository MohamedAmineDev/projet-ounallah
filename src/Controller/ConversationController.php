<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\User;
use App\Repository\ConversationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository;
/**
 * Class ConversationController
 * @package App\Controller
 * @Route("/conversations",name="conversations.")
 */
class ConversationController extends AbstractController
{
    /**
     * @var UtilisateurRepository
     */
private $utilisateurRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var $conversationRepository
     */
    private $conversationRepository;

    public function __construct(UserRepository $utilisateurRepository,
                                EntityManagerInterface $entityManager,
                                    ConversationRepository $conversationRepository)
    {

        $this->utilisateurRepository=$utilisateurRepository;
        $this->entityManager=$entityManager;
        $this->conversationRepository=$conversationRepository;
    }


    /**
     * @Route("/", name="NewConversation",methods={"POST"})
     * @param Request $request
     * @return  JsonResponse
     * @throws \Exception
     */
    public function index(Request $request): Response
    {

        $otherUser=$request->get('otherUser',0);
        $otherUser= $this->utilisateurRepository->find($otherUser);
        if(is_null($otherUser)){
            throw new \Exception("utilisateur nexiste pas");
        }
        // cannot create a conversation with myself
        if ($otherUser->getId() === $this->getUser()->getId()) {
            throw new \Exception("That's deep but you cannot create a conversation with yourself");
        }
//check si la conversation existe deja

        $conversation= $this->conversationRepository->findConversationByParticipants(
            $otherUser->getId(),
            $this->getUser()->getId()
        );


        if (count($conversation)){
         throw new \Exception("la conversation existe deja");
        }
        $conversation=new Conversation();
        $enqueteur= new Enqueteur();
        $enqueteur->setUtilisateur($this->getUser());
        $enqueteur->setConversation($conversation);


        $otherenqueteur= new User();
        $otherenqueteur->setUtilisateur($otherUser);
        $otherenqueteur->setConversation($conversation);


        $this->entityManager->getConnection()->beginTransaction();
        try{
                $this->entityManager->persist($conversation);
            $this->entityManager->persist($enqueteur);
            $this->entityManager->persist($otherenqueteur);


            $this->entityManager->flush();
                $this->entityManager->commit();
        }
        catch(\Exception $e){
            $this->entityManager->rollback();
            throw $e;
        }
        $this->entityManager->commit();
        return $this->json([
            'id'=>$conversation->getId()
        ], Response::HTTP_CREATED,[],[]
        );


    }
    /**
     * @Route("/",name="getConversations",methods={"GET"})
     */
    public  function getConvs (){
        $conversations=$this->conversationRepository->findConversationByUtilisateur($this->getUser()->getId());
        return $this->json($conversations);
    }
}
