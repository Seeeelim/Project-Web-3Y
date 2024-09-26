<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')] //Commande pour appeler le fichier home  Lancer le lien http://127.0.0.1:8000/home
    public function index():Response{ //response specifie le type de retour
        return $this->render('Home/home.html.twig'); //Donne une interface html / requete http
    }

    #[Route('/contact', name: 'app_contact')] //Commande pour appeler le fichier contact  Lancer le lien http://127.0.0.1:8000/contact
    public function contact():Response{ //response specifie le type de retour
        return $this->render('Home/contact.html.twig'); //Donne une interface html / requete http
    }
}
