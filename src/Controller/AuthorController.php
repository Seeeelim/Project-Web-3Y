<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/author')]
class AuthorController extends AbstractController
{
    #[Route('/show', name: 'app_author_show')]  //http://127.0.0.1:8000/author/show
    public function showAuthor(): Response
    {
        $authorName='Selim Harzallah';
        $authorEmail = 'selimharzallah@gmail.com';
        return $this->render('author/showAuthor.html.twig',
        array(
            'authorName' => $authorName,
            'authorEmail' => $authorEmail
        ));
    }

    #[Route('/list', name: 'app_author_list')]
    public function listAuthors(): Response
    {
        $authors=[
            ['authorName'=>'lamalll', 'picture'=>'images/picture1.jpg', 'authorEmail'=>'lamal@gmail.com', 'nbrBooks'=>201],
            ['authorName'=>'patron', 'picture'=>'images/made.png', 'authorEmail'=>'patron@gmail.com', 'nbrBooks'=>3]
        ];
        return $this->render('author/listAuthors.html.twig',
            array(
                'authors' => $authors
            ));
    }

    #[Route('/list', name: 'list_authors_by_library')]
    public function listAuthorsByLibrary(int $libraryId, AuthorRepository $authorRepository): Response
    {
        // Recherche des auteurs en fonction de l'identifiant de la bibliothèque
        $authors = $authorRepository->findBy(['library' => $libraryId]);

        $authorsData = [];
        foreach ($authors as $author) {
            $authorsData[] = [
                'id' => $author->getId(),
                'name' => $author->getName(),
                'email' => $author->getEmail(),
                'nbrBooks' => $author->getNbrBooks(),
                'address' => $author->getAddress(),
            ];
        }
        return $this->json($authorsData);
    }
}