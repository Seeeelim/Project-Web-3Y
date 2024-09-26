<?php

namespace App\Controller;

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
            ['authorName'=>'tata papa', 'picture'=>'images/picture1.jpg', 'authorEmail'=>'tata@gmail.com', 'nbrBooks'=>201],
            ['authorName'=>'patron', 'picture'=>'images/made.png', 'authorEmail'=>'patron@gmail.com', 'nbrBooks'=>3]
        ];
        return $this->render('author/listAuthors.html.twig',
            array(
                'authors' => $authors
            ));
    }
}
