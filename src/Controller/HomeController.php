<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RendezVousRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     * @Route("/home", name="home")
     */
    public function index(RendezVousRepository $rendezvous): Response
    {
        $rendezv = $rendezvous->findAll();
        //dd($rendezv);
        $rdvs = [];
        foreach ($rendezv as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'title' => $event->getName(),
                'begin'  => $event->getDate()->format('Y-m-d H:i:s'),
                'end' => $event->getDateEnd()->format('Y-m-d H:i:s'),
                'commercial' => $event->getCommercial(),
                'user' => $event->getUser()
            ];
        }
        dd($rdvs);
        $data = \json_encode($rdvs);
        return $this->render('home/index.html.twig', [
            'data' => $data,
        ]);
    }
}
