<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CrudproduitController extends AbstractController
{
    #[Route('/crudproduit', name: 'app_crudproduit')]
    public function index(): Response
    {
        return $this->render('crudproduit/index.html.twig', [
            'controller_name' => 'CrudproduitController',
        ]);
    }
}
