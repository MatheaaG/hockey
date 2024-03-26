<?php

namespace Controllers;

use Equipe;

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['Logged'])) {
    $urlRedirection = '?c=user&t=login';
    header("Location: $urlRedirection");
    exit;
}

class EquipeController extends Controller
{
    #[Role('ADMIN')]
    public function create($params)
    {
        $em=$params["em"];
        
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('v')
            ->from('Ville', 'v');

        $query = $queryBase->getQuery();
        $villes = $query->getResult();

        echo $this->twig->render('equipe/create_view.php', ['villes' => $villes]);
    }

    #[Role('ADMIN')]
    public function insert($params){

	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $em=$params["em"];
           
            $ville = $em->find("Ville", $_POST['ville_id']);
            $nameTeam = $_POST["equipe_name"]; 
            $logo = $_FILES["logo"]['tmp_name'];

            $newTeam = new Equipe();  
            $newTeam->setVille($ville);
            $newTeam->setNameTeam($nameTeam);
            $newTeam->setLogo(file_get_contents($logo));

            $em->persist($newTeam);
            $em->flush();

            $urlRedirection = '?c=equipe&t=list';
            header("Location: $urlRedirection");
            exit();
        }
    }
    #[Role('ADMIN')]
    public function list($params){
        $em=$params["em"];

        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('e')
            ->from('Equipe', 'e');

        $query = $queryBase->getQuery();
        $equipes = $query->getResult();
        
        echo $this->twig->render('equipe/list_view.php', ['equipes'=> $equipes]);

    }

    #[Role('ADMIN')]
    public function read($params){
        $id=$params["get"]["id"];
        $em=$params["em"];
        
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('j')
            ->from('Joueur', 'j')
            ->join('j.equipe', 'e')
            ->where('e.id = :equipeId')
            ->setParameter('equipeId', $id);
           
        $query = $queryBase->getQuery();
        $joueur = $query->getResult();
        
        $equipe = $em->find("Equipe", $id);
        //var_dump($joueur);die;
        
        echo $this->twig->render('equipe/read_view.php',['joueurs' => $joueur, 'equipe' => $equipe]);
    }

    #[Role('ADMIN')]
    public function edit($params){
        $id=$params["get"]["id"];
        $em=$params["em"];
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('v')
            ->from('Ville', 'v');

        $query = $queryBase->getQuery();
        $villes = $query->getResult();

        $equipe = $em->find('Equipe', $id);

        echo $this->twig->render('equipe/edit_view.php', ['equipe' => $equipe,'villes'=>$villes]); 
    }

    #[Role('ADMIN')]
    public function update($params) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $params["get"]["id"];
            $em = $params["em"];
    
            // Récupérer les données du formulaire
            $nameTeam = $_POST["equipe_name"];
            $villeId = $_POST['ville_id'];
            $logo = $_FILES["logo"]['tmp_name'];
    
            // Charger l'entité Equipe à mettre à jour
            $equipe = $em->find('Equipe', $id);
    
            // Charger l'entité Ville correspondante
            $ville = $em->find("Ville", $villeId);
    
            // Mettre à jour les champs de l'entité Equipe
            $equipe->setNameTeam($nameTeam);
            $equipe->setVille($ville);
            $equipe->setLogo(file_get_contents($logo));
    
            // Flush pour sauvegarder les modifications dans la base de données
            $em->flush();
    
            // Redirection vers la liste de toutes les équipes enregistrées
            $urlRedirection = '?c=equipe&t=list';
            header("Location: $urlRedirection");
            exit();
        }
    }
    
    #[Role('ADMIN')]
    public function delete($params){
        $id=$params["get"]["id"];
        $em=$params["em"];

        $equipe = $em->find('Equipe', $id);
        $em->remove($equipe);
        $em->flush();
        
        $urlRedirection = '?c=equipe&t=list';
        header("Location: $urlRedirection");
        exit();
    }
}
