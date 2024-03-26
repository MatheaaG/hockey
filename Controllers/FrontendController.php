<?php
 
// Chargement des classes
 
namespace Controllers;


class FrontendController extends Controller
{
    #[Role('Anonym')]
    function accueil()
    {
        echo $this->twig->render('frontend/accueil.php'); 
    }

    #[Role('Anonym')]
    function guide()
    {
        echo $this->twig->render('frontend/guide.php'); 
    }

    #[Role('Anonym')]
    function calendrier()
    {
        //echo $this->twig->render('frontend/calendrier.php'); 
        echo $this->twig->render('frontend/calendrier.php'); 
    }

}