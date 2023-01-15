<?php
// lien json
// "public\resource\listeVoiture.json"

namespace App\DataFixtures;

use App\Entity\Cars;
use App\Entity\Users;
use App\Entity\Images;
use App\Entity\Marque;
use App\Entity\Modele;
use DateTimeImmutable;
use App\Entity\Carburant;
use App\Entity\Equipement;
use App\Entity\TypeDeBoite;
use App\Entity\Transmission;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    // gestion du hash du password
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        // création d'un admin 
        $admin = new Users();
        $admin->setLastName('gallais')
            ->setFirstName('michel')
            ->setAddress('chaussée d\'aelbeke')
            ->setZipcode('7700')
            ->setCity('Mouscron')
            ->setCreatedAt(new DateTimeImmutable())
            ->setEmail('michel@gmail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin,'password'))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);


        // DEBUT de la gestion des marque et model lier par id 
            $jsonobj = file_get_contents($filname = "public/resource/listeVoiture.json");
            $arr = json_decode($jsonobj, true);
            $tabModel = [];

            foreach($arr as $name) {
                $marque = new Marque();
                $marquejson = $name["marque"];
                $marque->setName($marquejson);
                foreach($name["modeles"] as $name2) {
                    $modele = new Modele();
                    $models = $name2["model"];
                    $year = $name2["annee"];
                    $modele->setName($models)
                            ->setMarque($marque)
                            ->setYearModele($year);
                    $manager->persist($modele);
                    $tabModel[] = $modele;
                }
                $manager->persist($marque);
            }

        // FIN de la gestion des marque et model lier par id 

        // DEBUT de la gestion des options

        $optjsonobj = file_get_contents($filname = "public/resource/equipement.json");

        $arropt = json_decode($optjsonobj, true);

        $tabopt= [];

        foreach($arropt as $name) {
            $equipements = $name["equipement"];
            foreach($equipements as $equipement) {
                $opt = new Equipement();
                $opt->setName($equipement);
                $manager->persist($opt);
                $tabopt[] = $opt;
            }
        }

    // FIN de la gestion des options
        
        // DEBUT de la gestion des transmission
        
        $typeTransmis = ["Avant", "arrière", "4X4"];
        $tabTransmi = [];

        for ($i=0; $i <= 2; $i++) { 
            $transmi = new Transmission();
            $transmi->setType($typeTransmis[$i]);
            $manager->persist($transmi);
            $tabTransmi[] = $transmi;
        }
        
        // FIN de la gestion des transmission
        
        // DEBUT de la gestion des type de boite
        
        $typeBoites = ["manuelle", "automatique"];
        $tabBoites = [];

        for ($i=0; $i <= 1; $i++) { 
            $boite = new TypeDeBoite();
            $boite->setType($typeBoites[$i]);
            $manager->persist($boite);
            $tabBoites[] = $boite;
        }

        // FIN de la gestion des type de boite
        
        // DEBUT de la gestion des carburant
        
            $typecarbus = ["electrique", "essence", "diesel", "Hybrid"];
            $tabCarbu = [];

            for ($i=0; $i <= 3; $i++) { 
                $carburant = new Carburant();
                $carburant->setType($typecarbus[$i]);
                $manager->persist($carburant);
                $tabCarbu[] = $carburant;
            }
            $manager->flush();
            
        // FIN de la gestion des carburant

        // DEBUT de la gestion images

        $images = 'https://placehold.jp/150x150.png';
        $tabImage = [];
        for ($i=0; $i <= 3; $i++) { 
            $image = new Images();
            $image->setUrl($images);
            $manager->persist($image);
            $tabImage[] = $image;
        }

        $manager->flush();

        // FIN de la gestion images
     
        // DEBUT de la gestion d'une voiture en vente 

        for ($c=0; $c < 5; $c++) { 
            $randModel = $tabModel[rand(0, count($tabModel)-1)];
            $date = new DateTimeImmutable();
            $cover = 'https://placehold.jp/250x250.png';
            $car = new Cars();
            $car->setIdModele($randModel)
                ->setIdCarbu($tabCarbu[rand(0, count($tabCarbu)-1)])
                ->setIdTransmi($tabTransmi[rand(0, count($tabTransmi)-1)])
                ->setIdTypeDeBoite($tabBoites[rand(0, count($tabBoites)-1)])
                ->setPrice(rand(3000,20000))
                ->setCylindree(rand(800,3000))
                ->setPuissanceCh(rand(40,600))
                ->setPuissanceKw(rand(30,300))
                ->setKilometrage(rand(5000,300000))
                ->setNbProprio(rand(1,6))
                ->setYear($date)
                ->setDescription(
                    'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit nisi a quod corporis, doloribus quam possimus quas nesciunt architecto ipsum.'
                )
                ->setCover($cover);
                for ($i=0; $i <= rand(2,7); $i++) { 
                    $car->addImage($tabImage[rand(0,count($tabImage)-1)]);
                }
                for ($e=0; $e <= rand(4,10); $e++) { 
                    $car->addEquipement($tabopt[rand(0,count($tabopt)-1)]);
                }
                $manager->persist($car);
        }
                
        // FIN de la gestion d'une voiture en vente

        $manager->flush();
    }
}