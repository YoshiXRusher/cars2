<?php
// lien json
// "public\resource\listeVoiture.json"

namespace App\DataFixtures;

use App\Entity\Cars;
use App\Entity\Marque;
use App\Entity\Modele;
use DateTimeImmutable;
use App\Entity\Carburant;
use App\Entity\TypeDeBoite;
use App\Entity\Transmission;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // DEBUT de la gestion des marque et model lier par id 
            $jsonobj = file_get_contents($filname = "public/resource/listeVoiture.json");
            $arr = json_decode($jsonobj, true);

            foreach($arr as $name) {
                $marque = new Marque();
                $marquejson = $name["marque"];
                $marque->setName($marquejson);
                foreach($name["modeles"] as $name2) {
                    // $year = $name2["annee"];
                    $models = $name2["model"];
                    $modele = new Modele();
                    $modele->setName($models)
                            ->setMarque($marque);
                            // ->setYear($year)
                    $manager->persist($modele);
                }
                $manager->persist($marque);
            }

        // FIN de la gestion des marque et model lier par id 
        
        // DEBUT de la gestion des transmission
        
        $typeTransmis = ["Avant", "arrière", "4X4"];

        for ($i=0; $i <= 2; $i++) { 
            $transmi = new Transmission();
            $transmi->setType($typeTransmis[$i]);
            $manager->persist($transmi);
        }
        
        // FIN de la gestion des transmission
        
        // DEBUT de la gestion des type de boite
        
        $typeBoites = ["manuelle", "automatique"];

        for ($i=0; $i <= 1; $i++) { 
            $boite = new TypeDeBoite();
            $boite->setType($typeBoites[$i]);
            $manager->persist($boite);
        }

        // FIN de la gestion des type de boite
        
        // DEBUT de la gestion des carburant
        
            $typecarbus = ["electrique", "essence", "diesel", "Hybrid"];


            for ($i=0; $i <= 3; $i++) { 
                $carburant = new Carburant();
                $carburant->setType($typecarbus[$i]);
                $manager->persist($carburant);
            }

        // FIN de la gestion des carburant

        
        // DEBUT de la gestion d'une voiture en vente 
        // $model = $models[];
        // $typeBoite = $typeBoites[];
        // $typeTransmi = $typeTransmis[];
        // $typecarbu = $typecarbus[];
        $date = new DateTimeImmutable();
        $car = new Cars();
        $nbCarbu = count($carburant);
        $car->setIdModele($modele)
            ->setIdCarbu($carburant(rand(0,count($typecarbus)-1)))
            ->setIdTransmi($transmi)
            ->setIdTypeDeBoite($boite)
            ->setPrice(random_int(3000,20000))
            ->setCylindree(random_int(800,3000))
            ->setPuissanceCh(random_int(800,3000))
            ->setPuissanceKw(random_int(30,300))
            ->setKilometrage(random_int(5000,300000))
            ->setNbProprio(random_int(1,5))
            ->setYear($date)
            ->setDescription(
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit nisi a quod corporis, doloribus quam possimus quas nesciunt architecto ipsum.'
                )
            ->setidMarque($marque);

        $manager->persist($car);

        
        // FIN de la gestion d'une voiture en vente


        $manager->flush();
    }
}
