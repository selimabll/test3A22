<?php

namespace App\Controller;
use App\Entity\Categorie;

use App\Repository\CategorieRepository;
use App\Form\CategorieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/crud/Categorie')]
class CrudcategorieController extends AbstractController
{
    #[Route('/', name: 'app_crud_categorie')]
    public function index(CategorieRepository $repository,CategorieRepository $CategorieRep, Request $request): Response
    {   $CategorieName=$request->get('CategorieName');
        if($CategorieName==''){
            $Categorie=$repository->findAll();
        }else{
           
              $Categorie=$CategorieRep->findOneBy(['nom'=>$CategorieName]);
           
            $Categorie=$repository->findByCategorie($Categorie);
            if(count($Categorie)==0){
                return  new Response('No Categories found');
            }
        }
        return $this->render('crudcategorie/index.html.twig', [
            'Categorie' => $Categorie,
            'controller_name' => 'CrudCategorieController',
        ]);
    }

    #[Route('/new', name:'app_new_categorie')]
    public function newCategorie(Request $request,ManagerRegistry $doctrine):Response
    {  
        $categorie= new Categorie();
        
        $form=$this->createForm(CategorieType::class,$categorie);
       
        $form=$form->handleRequest($request);

       
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$doctrine->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('app_crud_categorie');
        }

        return $this->render('crudcategorie/form.html.twig',
        ['form'=>$form->createView()]);
    }


    #[Route('/edit/{id}', name:'app_editCategorie')]
    public function editCategorie(Request $request,ManagerRegistry $doctrine,Categorie $categorie):Response
    {

        
        $form=$this->createForm(CategorieType::class,$categorie);
        
        $form=$form->handleRequest($request);

        
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_crud_categorie');
        }

        return $this->render('crudcategorie/form.html.twig',
            ['form'=>$form->createView()]);
    }

}
