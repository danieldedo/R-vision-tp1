<?php

namespace App\DataFixtures;

use App\Entity\Sejour;
use App\Entity\Logement;
use App\Entity\Voyageur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // Voyageur
        $voyageur1 = new Voyageur();
        $voyageur1->setNom('Smith');
        $voyageur1->setPrenom('John');
        $voyageur1->setVille('New York');
        $voyageur1->setRegion('East Coast');
        $voyageur1->setSexe('Masculin');
        $manager->persist($voyageur1);

        $voyageur2 = new Voyageur();
        $voyageur2->setNom('Uzumaki');
        $voyageur2->setPrenom('Naruto');
        $voyageur2->setVille('Konoha');
        $voyageur2->setRegion('Pays du vent');
        $voyageur2->setSexe('Masculin');
        $manager->persist($voyageur2);


        // Logement
        $logement1 = new Logement();
        $logement1->setCode('XYZ123');
        $logement1->setNom('Appartement de Luxe');
        $logement1->setCapacite(4);
        $logement1->setType('Appartement');
        $logement1->setLieu('Centre-ville');
        $logement1->setDisponibilite(false);
        $manager->persist($logement1);
       
        $logement2 = new Logement();
        $logement2->setCode('ABC456');
        $logement2->setNom('Maison de Plage');
        $logement2->setCapacite(6);
        $logement2->setType('Maison');
        $logement2->setLieu('Plage');
        $logement2->setDisponibilite(true);
        $manager->persist($logement2);


        // Sejour
        $sejour1 = new Sejour();
        $sejour1->setVoyageur($voyageur1);
        $sejour1->setLogement($logement1);
        $manager->persist($sejour1);

        $sejour2 = new Sejour();
        $sejour2->setVoyageur($voyageur2);
        $sejour2->setLogement($logement2);
        $manager->persist($sejour2);

        


        $manager->flush();
    }
}
