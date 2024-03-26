<?php

namespace Controllers;

use Joueur;

class JoueurController extends Controller
{
    #[Role('ADMIN')]
    public function create($params)
    {
        
        //$id=$params["getParams"]["id"];
        $em=$params["em"];
        
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('e')
            ->from('Equipe', 'e');
            
/*
        //$equipe = $em->find('Equipe', $id);
*/
        $query = $queryBase->getQuery();
        $equipes = $query->getResult();
        
        echo $this->twig->render('joueurs/create_view.php', ['equipes' => $equipes]);
    }

    #[Role('ADMIN')]
    public function insert($params){

	    if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id=$params["get"]["id"];
            $em=$params["em"];
           
            $name = $_POST["player_name"];
            $firstName = $_POST["player_FirstName"];
            $old = $_POST["player_Old"];
            $number = $_POST["player_Number"];
            $position = $_POST["player_Position"];
            $nationality = $_POST["player_Nationality"]; 
            $teamPlayer = $_POST["equipe_id"];

            $equipe = $em->find('Equipe', $teamPlayer);
                
            $newPlayer = new Joueur();  
           
            $newPlayer->setNamePlayer($name);
            $newPlayer->setFirstNamePlayer($firstName);
            $newPlayer->setOld($old);
            $newPlayer->setNumber($number);
            $newPlayer->setPosition($position);
            $newPlayer->setNationality($nationality);
            $newPlayer->setEquipe($equipe);

            $em->persist($newPlayer);
            $em->flush();

            $urlRedirection = "?c=joueur&t=list";
            header("Location: $urlRedirection");
            exit();
        }
    }

    #[Role('ADMIN')]
    public function list($params){
        $em=$params["em"];

        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('j')
            ->from('Joueur', 'j');

        $query = $queryBase->getQuery();
        $joueurs = $query->getResult();
        
        echo $this->twig->render('joueurs/list_view.php', ['joueurs'=> $joueurs]);

    }

    #[Role('ADMIN')]
    public function edit($params){
        $id=$params["get"]["id"];
        $em=$params["em"];
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('e')
            ->from('Equipe', 'e');

        $query = $queryBase->getQuery();
        $equipes = $query->getResult();

        $joueur = $em->find('Joueur', $id);

        echo $this->twig->render('joueurs/edit_view.php', ['joueur' => $joueur, 'equipes' => $equipes]); 
    }

    #[Role('ADMIN')]
    public function update($params) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $params["get"]["id"];
            $em = $params["em"];
    
            // Récupérer les données du formulaire
            $name = $_POST["player_name"];
            $firstName = $_POST["player_FirstName"];
            $old = $_POST["player_Old"];
            $number = $_POST["player_Number"];
            $position = $_POST["player_Position"];
            $nationality = $_POST["player_Nationality"]; 
            $teamPlayer = $_POST["equipe_id"]; 
           
            // Charger l'entité Joueur à mettre à jour
            $newPlayer = $em->find('Joueur', $id);
            $equipe = $em->find('Equipe', $teamPlayer);
    
            // Mettre à jour les champs de l'entité Joueur 
            $newPlayer->setEquipe($equipe);
            $newPlayer->setNamePlayer($name);
            $newPlayer->setFirstNamePlayer($firstName);
            $newPlayer->setOld($old);
            $newPlayer->setNumber($number);
            $newPlayer->setPosition($position);
            $newPlayer->setNationality($nationality);

            // Flush pour sauvegarder les modifications dans la base de données
            $em->flush();
    
            // Redirection vers la liste de toutes les équipes enregistrées
            $urlRedirection = "?c=joueur&t=list";
            header("Location: $urlRedirection");
            exit();
        }
    }

    #[Role('ADMIN')]
    public function delete($params){
        $id = $params["get"]["id"];
        $em = $params["em"];
       
        // Récupérer le joueur
        $joueur = $em->find('Joueur', $id);
    
        // Vérifier si le joueur existe
        if (!$joueur) {
            // Gérer le cas où le joueur n'existe pas
            echo "Le joueur n'existe pas.";
            exit();
        }
    
        // Récupérer l'ID de l'équipe du joueur
        $equipeId = $joueur->getEquipe()->getId();
    
        // Supprimer le joueur
        $em->remove($joueur);
        $em->flush();
    
        // Rediriger vers la page de l'équipe
        $urlRedirection = "?c=joueur&t=list";
        header("Location: $urlRedirection");
        exit();
    }
    
    
}