<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Entity\Equipement;
use App\Entity\Images;
use App\Form\AddcarType;
use App\Repository\CarsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $opt = $car->getEquipements();

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
            'opt' => $opt,
        ]);
    }

    #[Route('/adm/addcar', name: 'addcar')]
    #[IsGranted("ROLE_ADMIN")]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $car = new Cars();
        
        $form = $this->createForm(AddcarType::class, $car);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            // test pour ajouter les equipement (a revoir)
            // $equipements = $form->getData()->getEquipements();
            // for ($e=0; $e <= count($equipements); $e++) {
            //     $equipement = $equipements[$e];
            //     dd($equipement);
            //     foreach ($equipement['name'] as $opt) {
            //         dd($opt);
            //     }
            // }
            $image = $form->get('Image')->getData();
            $img = new Images();
            $img->setUrl($image);
            $car->addImage($img);
            $manager->persist($car);
            $manager->flush();
        }

        return $this->render('addcar/addcar.html.twig', [
            'myform' => $form->createView()
        ]);
    }
}
