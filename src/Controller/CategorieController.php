<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategorieController extends AbstractController
{
    private $categorie;
    public function __construct(){
            $this->categorie=[
                ['id'=>1, 'nom'=>'categorie1'],
                ['id'=>2, 'nom'=>'categorie2'],
            ];
    }

    #[Route("/categorie/{name}",
       name:"app_categorie",
       methods:["GET"],
       defaults:["nom"=>"categorie1"])]
   public function showCategorie($nom){
       return $this->render('categorie/show.html.twig',
       array(
           'nom'=>$nom
       ));
   }

    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

     //return list of Categories
   #[Route("/list",name:"app_list",methods:["GET"])]
   public function categorieList(){

       return $this->render('categorie/list.html.twig',
       [
           'categorie'=>$this->categorie
       ]);
   }





}
