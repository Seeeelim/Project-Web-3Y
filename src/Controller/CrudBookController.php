<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Library;
use App\Form\BookType;
use App\Form\LibraryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud/book')]
class CrudBookController extends AbstractController
{
    #[Route('/new', name: 'app_list_book')]
    public function newBook(\Doctrine\Persistence\ManagerRegistry $doctrine, Request $request): Response
    {
        //1.create instance of book
        $book = new Book();
        //2.create interface
        $form = $this->createForm(BookType::class, $book);
        //4.get data from Form
        $form = $form->handleRequest($request);
        //5.check if the form is valid and submitted
        if($form->isSubmitted() && $form->isValid())
        {
            //6.getManager
            //7.save into database : flush
            $em = $doctrine->getManager();
            $em->persist($book);
            $em->flush();
            return $this->redirectToRoute('app_book_list');
        }
        //3.send it to the user
        return $this->render('crud_book/form.html.twig',
            ['form'=>$form->createView()]);
    }

    #[Route('/list', name: 'app_book_list')]
    public function listBooks(\App\Repository\BookRepository $repository): Response
    {
        $books = $repository->findAll();
        return $this->render('crud_book/list.html.twig',
            ['books'=>$books]);
    }
}
