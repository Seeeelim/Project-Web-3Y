<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud/author')]
class CrudAuthorController extends AbstractController
{
    #[Route('/list', name: 'app_crud_author')]
    //Récuperation et lire de la base de donnée, on utilise repository
    public function list(AuthorRepository $repository):Response
    {
        //Recupération des données (liste des auteurs)
        //$repository = new AuthorRepository(); //Plus besoin d'écrire cette ligne si elle est mise dans les paramaètres de la fonction
        $list = $repository->findAll();
        //var_dump($list);
        //die();
        return $this->render('crud_author/list.html.twig'
            ,['list'=>$list]);
    }

    //Méthode de recherche de l'auteur par nom
    #[Route('/search/{name}', name: 'app_crud_search')]
    public function searchByName(AuthorRepository $repository, Request $request):Response
    {
        $name = $request->get('name');

        //Use a method to make a reesearch by Name
        $authors = $repository->findByName($name);
        //var_dump($authors);die();
        return $this->render('crud_author/list.html.twig'
            ,['list'=>$authors]);
    }

    //Méthode d'insertion dans la base de donnée
    #[Route('/add', name:'app_new_author')]
    //Modification dans la base de donnée, on utilise doctrine
    public function addAuthor(ManagerRegistry $doctrine):Response
    {
        $author = new Author();
        $author->setName('Selimm');
        $author->setEmail('darzz@yahoo.fr');
        $author->setAddress('Tunis');
        $author->setNbrBooks('9');

        //Persist the object in the doctrine
        //commit
        $emanager = $doctrine->getManager();
        $emanager->persist($author);
        //push
        $emanager->flush(); //Toujours mettre ces trois lignes pour l'ajout, la suppression et la modification

        return $this->redirectToRoute('app_crud_author');
    }

    //Méthode de suppression
    #[Route('/delete/{id}', name:'app_delete_author')]
    public function deleteAuthor(Author $author, ManagerRegistry $doctrine):Response
    {
        $emanager = $doctrine->getManager();
        $emanager->remove($author);
        $emanager->flush();
        return $this->redirectToRoute('app_crud_author');
    }

    //Méthode d'update
    #[Route('/update/{id}', name:'app_update_author')]
    //On utilise request quand il ecrit qqchose dans l'url et qu'on l'utilise
    public function updateAuthor(Request $request, AuthorRepository $rep, ManagerRegistry $doctrine):Response
    {
        $id = $request->get('id');
        $author = $rep->find($id);

        $author->setEmail('aasaa@yahoo.fr');
        $emanager = $doctrine->getManager();
        $emanager->flush();

        return $this->redirectToRoute('app_crud_author');
    }
}