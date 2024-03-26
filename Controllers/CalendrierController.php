<?php

namespace Controllers;

use Calendrier;

class CalendrierController extends Controller
{
    #[Role('Anonym')]
    public function api($params) 
    {
        $em=$params["em"];
        $nbMatch = $params['get']["nb"];
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('c')
            ->from('Calendrier', 'c')
            ->setMaxResults($nbMatch);

        $query = $queryBase->getQuery();
        $calendriers = $query->getResult();
        $result=array();
        foreach ($calendriers as $calendrier){
            array_push($result,["Date"=>$calendrier->getDateTime(),"Equipes"=>[$calendrier->getEquipe1()->getNameTeam(),$calendrier->getEquipe2()->getNameTeam()],"Ville"=>[$calendrier->getVille()->getNameCity()],"Prix"=>[$calendrier->getPrix()],"Logo"=>[$calendrier->getEquipe1()->getLogo(), $calendrier->getEquipe2()->getLogo()], "Score"=>[$calendrier->getScore1(), $calendrier->getScore2()]]);    
        }
        //var_dump($result);die;
        echo (json_encode($result));
    }

    #[Role('ADMIN')]
    public function create($params)
    {
        $em=$params["em"];
        
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('v')
            ->from('Ville', 'v');

        $query = $queryBase->getQuery();
        $villes = $query->getResult();

        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('e')
            ->from('Equipe', 'e');

        $query = $queryBase->getQuery();
        $equipes = $query->getResult();

        echo $this->twig->render('calendrier/create_view.php', ['villes' => $villes, 'equipes' => $equipes]);
    }

    #[Role('ADMIN')]
    public function insert($params){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $em = $params["em"];
    
            $ville = $em->find("Ville", $_POST['ville_id']);
            $equipe1 = $em->find("Equipe", $_POST['equipe1_id']);
            $equipe2 = $em->find("Equipe", $_POST['equipe2_id']);

            $format = "Y-m-d\TH:i"; // Format pour l'heure & la date

            // Convertir la chaîne de caractères en objet DateTime
            $dateTime = \DateTime::createFromFormat($format, $_POST["dateTime"]);

            //$dateTime = $_POST["dateTime"];
            $prix = $_POST["prix"];
            $score1 = $_POST["score1"];
            $score2 = $_POST["score2"];

            $newMatch = new Calendrier();
            $newMatch->setVille($ville);
            $newMatch->setEquipe1($equipe1);
            $newMatch->setEquipe2($equipe2);
            $newMatch->setDateTime($dateTime);
            $newMatch->setPrix($prix);
            $newMatch->setScore1($score1);
            $newMatch->setScore2($score2);
          
            $em->persist($newMatch);
            $em->flush();
    
            $urlRedirection = '?c=calendrier&t=list';
            header("Location: $urlRedirection");
            exit();
        }
    }
    
    #[Role('ADMIN')]
    public function list($params){
        $em=$params["em"];

        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('c')
            ->from('Calendrier', 'c');

        $query = $queryBase->getQuery();
        $calendriers = $query->getResult();
        
        echo $this->twig->render('calendrier/list_view.php', ['calendriers'=> $calendriers]);
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

        $queryBase2= $em->createQueryBuilder();
        $queryBase2 ->select('e')
            ->from('Equipe', 'e');

        $query2 = $queryBase2->getQuery();
        $equipes = $query2->getResult();


        $calendrier = $em->find('Calendrier', $id);
        echo $this->twig->render('calendrier/edit_view.php', ['calendrier' => $calendrier,'villes'=>$villes, 'equipes'=>$equipes]); 
    }

    #[Role('ADMIN')]
    public function update($params) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $params["get"]["id"];
            $em = $params["em"];
    
            // Récupérer les données du formulaire
            $equipe1ID = $_POST["equipe1_id"];
            $equipe2ID = $_POST["equipe2_id"];
            $prix = $_POST["prix"];
            $dateTimeString = $_POST["dateTime"];
            $villeId = $_POST["ville_id"];
            $score1 = $_POST["score1"];
            $score2 = $_POST["score2"];
            // Charger l'entité Calendrier à mettre à jour
            $calendrier = $em->find('Calendrier', $id);
    
            // Charger l'entité Ville et équipe correspondante
            $ville = $em->find("Ville", $villeId);
            $equipe1 = $em->find("Equipe", $equipe1ID);
            $equipe2 = $em->find("Equipe", $equipe2ID);

            //conversion de dateTime 
            $dateTime = \DateTime::CreateFromFormat('Y-m-d\TH:i', $dateTimeString);

            // Mettre à jour les champs de l'entité Equipe
            $calendrier->setEquipe1($equipe1);
            $calendrier->setEquipe2($equipe2);
            $calendrier->setPrix($prix);
            $calendrier->setDateTime($dateTime);
            $calendrier->setVille($ville);
            $calendrier->setScore1($score1);
            $calendrier->setScore2($score2);
    
            // Flush pour sauvegarder les modifications dans la base de données
            $em->flush();
    
            // Redirection vers la liste de tous les matchs enregistrées
            $urlRedirection = '?c=calendrier&t=list';
            header("Location: $urlRedirection");
            exit();
        }
    }

    #[Role('ADMIN')]
    public function delete($params){
        $id=$params["get"]["id"];
        $em=$params["em"];

        $calendrier = $em->find('Calendrier', $id);
        $em->remove($calendrier);
        $em->flush();
        
        $urlRedirection = '?c=calendrier&t=list';
        header("Location: $urlRedirection");
        exit();
    }
}
