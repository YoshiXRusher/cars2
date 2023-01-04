<?php

namespace App\Controller;

use App\Entity\Carburant;
use App\Repository\CarburantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/','home.index', methods: ['GET'])]
    public function index(CarburantRepository $repo): Response
    {

        $carbu = $repo->findAll();
        dd($carbu);

        return $this->render('home.html.twig',[

        ]);
    }
}