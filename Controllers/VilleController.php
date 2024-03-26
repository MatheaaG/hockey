<?php

namespace Controllers;

use Ville;

class VilleController extends Controller
{
    #[Role('ADMIN')]
    public function create($params) {
        $em=$params["em"];
        
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('v')
            ->from('Ville', 'v');

        $query = $queryBase->getQuery();
        $villes = $query->getResult();

        echo $this->twig->render('villes/create_view.php', ['villes' => $villes]);   
    }
    
    #[Role('ADMIN')]
    public function read($params) {
        $em=$params["em"];

        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('v')
            ->from('Ville', 'v');

        $query = $queryBase->getQuery();
        $villes= $query->getResult();

        echo $this->twig->render('villes/list_view.php', ['villes'=> $villes]);
    }

    #[Role('ADMIN')]
    public function update($params) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $params["get"]["id"];
            $em = $params["em"];
    
            // Récupérer les données du formulaire
            $nameCity = $_POST["ville"];
            $codePostal = $_POST['code_postal'];
    
            // Charger l'entité Ville à mettre à jour
            $ville = $em->find('Ville', $id);
    
            // Mettre à jour les champs de l'entité Equipe
            $ville->setNameCity($nameCity);
            $ville->setCodePostal($codePostal);
    
            // Flush pour sauvegarder les modifications dans la base de données
            $em->flush();
    
            // Redirection vers la liste de toutes les équipes enregistrées
            $urlRedirection = '?c=ville&t=read';
            header("Location: $urlRedirection");
            exit();
        }
    }

    #[Role('ADMIN')]
    public function delete($params){
        $id=$params["get"]["id"];
        $em=$params["em"];

        $ville = $em->find('Ville', $id);
        $em->remove($ville);
        $em->flush();
        
        $urlRedirection = '?c=ville&t=read';
        header("Location: $urlRedirection");
        exit();
    }

    #[Role('ADMIN')]
    public function insert($params){

	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $em=$params["em"];
           
            $ville = $_POST['ville'];
            $codePostal = $_POST["code_postal"]; 
            
            $newCity = new Ville();  
            $newCity->setNameCity($ville);
            $newCity->setCodePostal($codePostal);

            $em->persist($newCity);
            $em->flush();

            $urlRedirection = '?c=ville&t=read';
            header("Location: $urlRedirection");
            exit();
        }
    }

    #[Role('ADMIN')]
    public function edit($params){
        $id=$params["get"]["id"];
        $em=$params["em"];

        $ville = $em->find('Ville', $id);

        echo $this->twig->render('villes/edit_view.php', ["ville"=>$ville]);
    }    
}





?>