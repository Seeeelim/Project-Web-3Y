<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud/author')]
class CrudAuthorController extends AbstractController
{
    #[Route('/list', name: 'app_crud_author')]
    public function list(AuthorRepository $repository): Response
    {
        //Recupération des données (liste des auteurs)
        //$repository = new AuthorRepository(); //Plus besoin d'écrire cette ligne si elle est mise dans les paramaètres de la fonction
        $list = $repository->findAll();
        //var_dump($list);
        //die();
        return $this->render('crud_author/list.html.twig'
            ,['list'=>$list]);
    }
}
