<?php

namespace App\Controller;

use App\Entity\Cars;
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

    #[Route('/info/car/{id}', name: 'info')]
    public function info(Cars $car): Response
    {
        $id = $car->getId();
        $km = $car->getKilometrage();
        $price = $car->getPrice();
        $proprio = $car->getNbProprio();
        $cylidree = $car->getCylindree();
        $ch = $car->getPuissanceCh();
        $annee = $car->getYear();
        $desc = $car->getDescription();
        $model = $car->getIdModele();
        $carbu = $car->getIdCarbu();
        $transmi = $car->getIdTransmi();
        $img = $car->getImages();
        $boite = $car->getIdTypeDeBoite();

        return $this->render('showroom/info.html.twig', [
            'id' => $id,
            'model' => $model,
            'desc' => $desc,
            'km' => $km,
            'price' => $price,
            'proprio' => $proprio,
            'cylidree' => $cylidree,
            'ch' => $ch,
            'annee' => $annee,
            'carbu' => $carbu,
            'transmi' => $transmi,
            'img' => $img,
            'boite' => $boite,
        ]);
    }
}
