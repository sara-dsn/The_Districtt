<?php

namespace App\DataFixtures;

use App\Entity\Plat;
use App\Entity\User;
use App\Entity\Commande;
use App\Entity\Categorie;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $BoissonFroide= new Categorie();
        $BoissonFroide->setLibelle("Boisson Froide");
        $BoissonFroide->setImage('boisson_froide.webp');
        $BoissonFroide->setActive('1');

        $manager->persist($BoissonFroide);
        $manager->flush();

        $BoissonChaude= new Categorie();
        $BoissonChaude->setLibelle("Boisson Chaude");
        $BoissonChaude->setImage('boisson_chaude.webp');
        $BoissonChaude->setActive('1');

        $manager->persist($BoissonChaude);
        $manager->flush();

        $Dessert= new Categorie();
        $Dessert->setLibelle("Dessert");
        $Dessert->setImage('dessert.webp');
        $Dessert->setActive('1');

        $manager->persist($Dessert);
        $manager->flush();

        $caramel=new Plat();
        $caramel->setLibelle('Iced Caramel Macchiato');
        $caramel->setImage('caramel.webp');
        $caramel->setDescription("Du lait saveur vanille taché d'un espresso surmonté d'un nappage saveur caramel, servi glacé.");
        $caramel->setPrix(5,50);
        $caramel->setActive(1);
        $caramel->setCategorie($BoissonFroide);

        $manager->persist($caramel);
        $manager->flush();

        $matcha=new Plat();
        $matcha->setLibelle("Frappuccino Matcha");
        $matcha->setImage("matcha.webp");
        $matcha->setDescription("Essayez votre Matcha préféré dans un Frappuccino - Le Matcha est combiné avec du lait , une sauce saveur chocolat,  et de la vanille et garni de crème fouettée.");
        $matcha->setPrix(5);
        $matcha->setActive(1);
        $matcha->setCategorie($BoissonFroide);

        $manager->persist($matcha);
        $manager->flush();


        $mojito=new Plat();
        $mojito->setLibelle("Virgin Mojito");
        $mojito->setImage("mojito.webp");
        $mojito->setDescription("Un cocktail mojito à la menthe fraîche et au citron sans alcool, à consommer sans modération!");
        $mojito->setPrix(6);
        $mojito->setActive(1);
        $mojito->setCategorie($BoissonFroide);

        $manager->persist($mojito);
        $manager->flush();


        $latte=new Plat();
        $latte->setLibelle("Café latté");
        $latte->setImage("cafe_latte.webp");
        $latte->setDescription("L'intensité de notre espresso rencontre la douceur du lait chauffé à la vapeur, le tout recouvert d'une fine couche de mousse de lait. ");
        $latte->setPrix(3);
        $latte->setActive(1);
        $latte->setCategorie($BoissonChaude);

        $manager->persist($latte);
        $manager->flush();


        $Banana=new Plat();
        $Banana->setLibelle("Banana Split");
        $Banana->setImage("bananaSplit.webp");
        $Banana->setDescription("Succomber au classique banana split composé de banane, boule de sorbet fraise, boule de glace vanille, boule de glace chocolat, sauce chocolat chaud, crème fouettée et ses éclats croquant de noix pécan enrobé de chocolat.");
        $Banana->setPrix(6);
        $Banana->setActive(1);
        $Banana->setCategorie($Dessert);

        $manager->persist($Banana);
        $manager->flush();

        $Homer = new User();
        $Homer->setEmail('Homer@gmail.com');
        $Homer->setPassword('$2y$13$BfjzBCuUsU6BamOH.dEfQO0F4oSlqngUk0DNxepsjOO8ArxTW6.Tm');
        $Homer->setNom('Simpson');
        $Homer->setPrenom('Homer');
        $Homer->setAdresse('742 evergreen terrasse');
        $Homer->setCp(62736);
        $Homer->setVille('Springfield');
        $Homer->setRoles(['ROLE_CLIENT']);
        $Homer->setTelephone('0123456789');
        $Homer->setIsVerified(1);

        $manager->persist($Homer);
        $manager->flush();

        $Marge = new User();
        $Marge->setEmail('Marge@gmail.com');
        $Marge->setPassword('$2y$13$7nwjrjiPH8Mmo0/baFVleenUbA7.M0BYpHWWDzqZW416hjcDmzUP6');
        $Marge->setNom('Simpson');
        $Marge->setPrenom('Marge');
        $Marge->setAdresse('742 evergreen terrasse');
        $Marge->setCp(62736);
        $Marge->setVille('Springfield');
        $Marge->setRoles(['ROLE_CLIENT']);
        $Marge->setTelephone(9876543210);
        $Marge->setIsVerified(1);

        $manager->persist($Marge);
        $manager->flush();

$date=new DateTime('now');

        $commandeHomer= new Commande();
        $commandeHomer->setDateCommande($date);
        $commandeHomer->setTotal(6);
        $commandeHomer->setEtat(0);
        $commandeHomer->setUtilisateur($Homer);
        
        $manager->persist($commandeHomer);
        $manager->flush();


        $commandeMarge= new Commande();
        $commandeMarge->setDateCommande($date);
        $commandeMarge->setTotal(3);
        $commandeMarge->setEtat(0);
        $commandeMarge->setUtilisateur($Marge);
        
        $manager->persist($commandeMarge);
        $manager->flush();
    }
}
