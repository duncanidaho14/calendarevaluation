<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\CommercialRepository;
use App\Repository\RendezVousRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     * @Route("/home", name="home")
     * @IsGranted("ROLE_USER")
     */
    public function index(RendezVousRepository $rendezvous, CommercialRepository $commercial, UserRepository $userRepository): Response
    {
        $rendezv = $rendezvous->findAll();
        $comm = $commercial->findAll();
        $users = $userRepository->findAll();
        //dd($rendezv);
        $rdvs = [];
        $rdvCom = [];
        $rdvUser = [];
        foreach ($rendezv as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'title' => $event->getName(),
                'start'  => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s')
            ];
            foreach ($comm as $com) {
                $rdvCom[] = [
                    'id' => $com->getId(),
                    'firstname' => $com->getFirstName(),
                    'lastname' => $com->getLastName(),
                    'email' => $com->getEmail(),
                    'phone' => $com->getPhone(),
                ];
            }
            
            foreach ($users as $user) {
                $rdvUser[] = [
                    'id' => $user->getId(),
                    'fistName' => $user->getFirstName(),
                    'lastName' => $user->getLastName(),
                    'email' => $user->getEmail(),
                    'phone' => $user->getPhone(),


                ];
            }
        }
        //dd($rdvCom, $rdvUser, $rdvs);
        $push = [];
        $push = array_merge($push, $rdvs, $rdvCom, $rdvUser);

        $data = \json_encode($rdvs);
        $rdvCom = \json_encode($rdvCom);
        $rdvUser = \json_encode($rdvUser);
        $push = \json_encode($push);

        return $this->render('home/index.html.twig', [
            'data' => $data,
            'commercial' => $rdvCom,
            'user' => $rdvUser,
            'push' => $push
        ]);
    }
}
