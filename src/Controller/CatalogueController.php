<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use App\Repository\DetailRepository;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogueController extends AbstractController
{
    private $detailRepo;
    private $categorieRepo;
    private $platRepo;
    public function __construct(CategorieRepository $categorieRepo, PlatRepository $platRepo, DetailRepository $detailRepo){
        $this->categorieRepo = $categorieRepo;
        $this->platRepo = $platRepo;
        $this->detailRepo =$detailRepo;

    }
 
    
    #[Route('/', name: 'app_accueil')]
    public function accueil(): Response
    {
        // $class=new PlatRepository(ManagerRegistry);
        // // $session=$request->getSession();
        // $best=$class->BestSeller();
        $categorie=$this->categorieRepo->findBy( ['active'=>1], null ,$limit='9');
        $plat=$this->platRepo->findBy( ['active'=>1], null ,$limit='3');
        $platsm=$this->platRepo->findBy( ['active'=>1], null ,$limit='9');

        return $this->render('accueil/accueil.html.twig', [
            'categorie'=>$categorie,
            'plat'=>$plat,
            'platsm'=>$platsm

        ]);
    }
    #[Route('/categorie', name: 'app_categorie')]
    public function categorie(): Response
    {

        $categorie=$this->categorieRepo->findBy( ['active'=>1], null ,$limit='9');

        return $this->render('accueil/categorie.html.twig', [
        'categorie'=>$categorie
        ]);
    }
    #[Route('/plat', name: 'app_plat')]
    public function plat(): Response
    {

        $plt=$this->platRepo->findBy( ['active'=>1], null ,$limit='9');
        return $this->render('accueil/plat.html.twig', [
            'plat'=>$plt
        ]);
    }
  
  
    #[Route('/politique', name: 'app_politique')]
    public function politique(): Response
    {
        return $this->render('RGPD/politique.html.twig', [
        ]);
    }
    #[Route('/mention', name: 'app_mention')]
    public function mention(): Response
    {

        return $this->render('RGPD/mention.html.twig', [
        ]);
    }
    #[Route('/CGU', name: 'app_CGU')]
    public function CGU(): Response
    {

        return $this->render('RGPD/CGU.html.twig', [
        ]);
    }
    #[Route('/livreur', name: 'app_livreur')]
    public function livreur(): Response
    {
        
        return $this->render('message/livreur.html.twig', [
        ]);
    }
    #[Route('/demande', name: 'app_demande')]
    public function demande(): Response
    {

        return $this->render('message/demande.html.twig', [
        ]);
    }
   
    #[Route('/plats/{categorie_id}', name: 'app_onClickCat')]
    public function onClickCat($categorie_id):Response
    {
        //  Dans $categorie_id on a l'id exacte de la categorie (id = categorie_id), on récupere l'objet categorie en entier:
        $ctg=$this->categorieRepo->find($categorie_id);
        // On récupere tout les plats de la categorie (cette fonction est dans l'objet que l'on a récupérer):
        $plt=$ctg->getPlats();

        return $this->render('accueil/onClickCat.html.twig',[
            'plat'=>$plt,
            'categorie'=>$ctg,
        ]);
    }

 #[Route('/formulaire', name: 'app_formulaire')]
    public function formulaire(): Response
    {
        if(isset($_POST["envoyer"])){

            $nom=$_POST["nom"];
            $prenom=$_POST["prenom"];
            $email=$_POST["email"];
            $telephone=$_POST["telephone"];
            $demande=$_POST["demande"];
            
            function n($nom){
                $validation= "/^[a-zA-Z]+$/";
                if (preg_match($validation,$nom)){
            return true;
                }
                else{
                    return false;
                    echo " <p>Veuillez entre votre nom s.v.p<p>";
                };
            };
            function p($prenom){
                $validation= "/^[a-zA-Z]+$/";
                if (preg_match($validation,$prenom)){
            return true;
                }
                else{
                    return false;
                    echo " <p>Veuillez entre votre prenom s.v.p<p>";
                };
            };
            function e($email){
                $validation= "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/";
                if (preg_match($validation,$email)){
            return true;
                }
                else{
                    return false;
                    echo " <p>Veuillez entre votre email s.v.p<p>";
                };
            };
            function t($telephone){
                $validation= "/^[0-9]{10,}$/";
                if (preg_match($validation,$telephone)){
            return true;
                }
                else{
                    return false;
                    echo " <p>Veuillez entre votre numéro de téléphone s.v.p<p>";
                };
            };
            function d($demande){
                $validation= "/^[a-zA-Z]+$/";
                if (preg_match($validation,$demande)){
            return true;
                }
                else{
                    return false;
                    echo " <p>Veuillez entre votre demande s.v.p<p>";
                };
            };
             if(n($nom)==true&p($prenom)==true&e($email)==true &t($telephone)==true &d($demande)==true){
               
            $_SESSION["nom"]=$nom;
            $_SESSION["prenom"]=$prenom;
            $_SESSION["email"]=$email;
            $_SESSION["telephone"]=$telephone;
            $_SESSION["demande"]=$demande;
            $nomFichier=date("Y-m-d-H-i-s");
            $contenuFichier="Nom : ".$_SESSION["nom"]
            ."\r\n Prenom : ".$_SESSION["prenom"]
            ."\r\n  Email : ".$_SESSION["email"]
            ."\r\n  Telephone : ".$_SESSION["telephone"]
            ."\r\n  Demande :".$_SESSION["demande"];
            file_put_contents($nomFichier,$contenuFichier);
            header("Location: app_demande");
            exit();
            }
             else{
            unset($_SESSION);
            session_destroy();
            // echo "Veuillez remplir correctement le formulaire s.v.p <br>";
            // echo "nom: ".n($nom);
            // echo "<br>prenom: ".p($prenom);
            // echo "<br>email: ".e($email);
            // echo "<br>telephone: ".t($telephone);
            // echo "<br>demande: ".d($demande);
            header("Location: app_contact");
            exit();
            
             };
            
            
            
             
            };
            
        return $this->redirectToRoute('app_demande');
    }}