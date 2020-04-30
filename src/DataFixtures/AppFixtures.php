<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Hotel;
use App\Entity\Categorie;
use App\Entity\Chambre;
use App\Entity\Tarifer;
use App\Entity\Client;
use App\Entity\Reservation;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $hotel1 = new Hotel();
        $hotel1->setNom("Trump Hotel")
               ->setNumeroAdresse("15")
               ->setNomAdresse("American Street")
               ->setVille("New-York")
               ->setCodePostal("10005")
               ->setPays("United States of America")
               ->setTelephone("+12135096995")
               ->setEmail("trump-hotel@magicotel.com");
        $manager->persist($hotel1);

        $hotel2 = new Hotel();
        $hotel2->setNom("Macron Hotel")
               ->setNumeroAdresse("18")
               ->setNomAdresse("Avenue des Champs-Elysées")
               ->setVille("Paris")
               ->setCodePostal("95000")
               ->setPays("France")
               ->setTelephone("+33190254678")
               ->setEmail("macron-hotel@magicotel.com");
        $manager->persist($hotel2);

        $categorie1 = new Categorie();
        $categorie1->setNbrePersonnes(1)
                   ->setLitSimple(1)
                   ->setLitDouble(null)
                   ->setLitKing(null)
                   ->setNom("Simple");
        $manager->persist($categorie1);

        $categorie2 = new Categorie();
        $categorie2->setNbrePersonnes("2")
                   ->setLitSimple(2)
                   ->setLitDouble(null)
                   ->setLitKing(null)
                   ->setNom("Twin");
        $manager->persist($categorie2);

        $categorie3 = new Categorie();
        $categorie3->setNbrePersonnes("2")
                   ->setLitSimple(null)
                   ->setLitDouble(1)
                   ->setLitKing(null)
                   ->setNom("Double");
        $manager->persist($categorie3);

        $categorie4 = new Categorie();
        $categorie4->setNbrePersonnes("3")
                   ->setLitSimple(1)
                   ->setLitDouble(1)
                   ->setLitKing(null)
                   ->setNom("Double +");
        $manager->persist($categorie4);

        $categorie5 = new Categorie();
        $categorie5->setNbrePersonnes("4")
                   ->setLitSimple(2)
                   ->setLitDouble(null)
                   ->setLitKing(1)
                   ->setNom("Prestige");
        $manager->persist($categorie5);

        $chambre1 = new Chambre();
        $chambre1->setNumeroChambre(001)
                 ->setHotel($hotel1)
                 ->setCategorie($categorie1);
        $manager->persist($chambre1);

        $chambre2 = new Chambre();
        $chambre2->setNumeroChambre(002)
                 ->setHotel($hotel1)
                 ->setCategorie($categorie2);
        $manager->persist($chambre2);

        $chambre3 = new Chambre();
        $chambre3->setNumeroChambre(011)
                 ->setHotel($hotel1)
                 ->setCategorie($categorie3);
        $manager->persist($chambre3);

        $chambre4 = new Chambre();
        $chambre4->setNumeroChambre(012)
                 ->setHotel($hotel1)
                 ->setCategorie($categorie4);
        $manager->persist($chambre4);

        $chambre5 = new Chambre();
        $chambre5->setNumeroChambre(012)
                 ->setHotel($hotel1)
                 ->setCategorie($categorie5);
        $manager->persist($chambre5);

        $chambre6 = new Chambre();
        $chambre6->setNumeroChambre(001)
                 ->setHotel($hotel2)
                 ->setCategorie($categorie1);
        $manager->persist($chambre6);

        $chambre7 = new Chambre();
        $chambre7->setNumeroChambre(002)
                 ->setHotel($hotel2)
                 ->setCategorie($categorie2);
        $manager->persist($chambre7);

        $chambre8 = new Chambre();
        $chambre8->setNumeroChambre(011)
                 ->setHotel($hotel2)
                 ->setCategorie($categorie3);
        $manager->persist($chambre8);

        $chambre9 = new Chambre();
        $chambre9->setNumeroChambre(012)
                 ->setHotel($hotel2)
                 ->setCategorie($categorie4);
        $manager->persist($chambre9);

        $chambre10 = new Chambre();
        $chambre10->setNumeroChambre(012)
                 ->setHotel($hotel2)
                 ->setCategorie($categorie5);
        $manager->persist($chambre10);

        $tarifer1 = new Tarifer();
        $tarifer1->setTarif(70)
                 ->setCategorie($categorie1)
                 ->setHotel($hotel1);
        $manager->persist($tarifer1);

        $tarifer2 = new Tarifer();
        $tarifer2->setTarif(75)
                 ->setCategorie($categorie2)
                 ->setHotel($hotel1);
        $manager->persist($tarifer2);

        $tarifer3 = new Tarifer();
        $tarifer3->setTarif(120)
                 ->setCategorie($categorie3)
                 ->setHotel($hotel1);
        $manager->persist($tarifer3);

        $tarifer4 = new Tarifer();
        $tarifer4->setTarif(225)
                 ->setCategorie($categorie4)
                 ->setHotel($hotel1);
        $manager->persist($tarifer4);

        $tarifer5 = new Tarifer();
        $tarifer5->setTarif(80)
                 ->setCategorie($categorie1)
                 ->setHotel($hotel2);
        $manager->persist($tarifer5);

        $tarifer6 = new Tarifer();
        $tarifer6->setTarif(85)
                 ->setCategorie($categorie2)
                 ->setHotel($hotel2);
        $manager->persist($tarifer6);

        $tarifer7 = new Tarifer();
        $tarifer7->setTarif(170)
                 ->setCategorie($categorie3)
                 ->setHotel($hotel2);
        $manager->persist($tarifer7);

        $tarifer8 = new Tarifer();
        $tarifer8->setTarif(300)
                 ->setCategorie($categorie4)
                 ->setHotel($hotel2);
        $manager->persist($tarifer8);

        $client1 = new Client();
        $client1->setNom("Pentier")
                ->setPrenom("Pierre")
                ->setEmail("pentier.pierre@yahoo.fr")
                ->setTelephone("0781391499")
                ->setNumeroAdresse("158")
                ->setNomAdresse("rue Maurice Ravel")
                ->setVille("Nieppe")
                ->setCodePostal("59850")
                ->setPays("France");
        $manager->persist($client1);
        
        $reservation1 = new Reservation();
        $date = new DateTime("2020-07-30");
        $date2 = new DateTime("2020-08-07");
        $interval = date_diff($date, $date2);
        $reservation1->setDateDebut($date)
                     ->setDateFin($date2)
                     ->setNbrNuitees($interval->format('%a'))
                     ->setPrixTotal($interval->format('%a')*$tarifer1->getTarif())
                     ->setClient($client1)
                     ->setChambre($chambre1);
        $manager->persist($reservation1);


        $manager->flush();
    }
}
