<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowRoomController extends AbstractController
{
    #[Route('/showroom', name: 'showroom')]
    public function index(CarsRepository $repo): Response
    {
        $cars = $repo->findAll();

        return $this->render('showroom/index.html.twig', [
            'car' => $cars,
        ]);
    }
}
