<?php

namespace Controllers;

use User;

class UserController extends Controller
{
    #[Role('Anonym')]
    public function login($params) 
    {
        echo $this->twig->render('user/login.php'); 
    }

    #[Role('Anonym')]
    public function logout($params) 
    {
        $_SESSION['Logged']=false;
        $urlRedirection = '?c=user&t=login';
        header("Location: $urlRedirection");
        exit();
    }
    
    #[Role('Anonym')]
    public function check($params)
    {
        
        $em = $params['em'];
        $url= $params['url'];
        $login=$_POST['login'];
        $password=$_POST['password'];
        
        //Recherche de l'utilisateur dans la base de données
        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from('User', 'u')
            ->where('u.login = :login')
            ->setParameter("login",$login );
           
        $query = $qb->getQuery();
        $users= $query->getResult();
      
        if (sizeof($users)>0 ) {
            $user=$users[0];
            
            if ($user->getPassword() == $password) {

                $_SESSION['Logged']=true;
                $_SESSION['user_id'] = $user->getId(); // Stocker uniquement l'ID de l'utilisateur
               
                $urlRedirection = 'cli-config.php?c=equipe&t=list';
                header("Location: $urlRedirection");
                exit();
            }
            else {
                $_SESSION['Logged']=false;
                $urlRedirection = '?c=user&t=login&message=Mot de passe incorrect';
                header("Location: $urlRedirection");
                exit();    
            }
        }
        else {
            $user=null;
            $_SESSION['Logged']=false;
            $urlRedirection = "?c=user&t=login&message=Cet utilisateur n'existe pas";
            header("Location: $urlRedirection");
            exit();    
        }    
    }

    #[Role('ADMIN')]
    public function list($params) {
        
        $connectUser="tous";
        $em=$params["em"];
        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from('User', 'u');
        
        $query = $qb->getQuery();
       
        $users = $query->getResult();
        
        echo $this->twig->render('user/list_view.php', ['connectUser' =>   $connectUser,'users'=>$users]);
        
    }

    #[Role('ADMIN')]
    public function create($params) {
        $em=$params["em"];
        
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('d')
            ->from('Droit', 'd');

        $query = $queryBase->getQuery();
        $roles = $query->getResult();

        echo $this->twig->render('user/create.php', ['roles' => $roles]);
    }

    #[Role('ADMIN')]
    public function insert($params) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $em=$params["em"];
           
            $role = $em->find("Droit", $_POST['role_id']);
            $lastName = $_POST["nom"]; 
            $firstName = $_POST["prenom"]; 
            $login = $_POST["login"];
            $password = $_POST["password"];
            $dateBirth = $_POST["date_naissance"];
            $avatar = $_FILES["avatar"]['tmp_name'];
            
            //conversion de dateTime 
            $date = \DateTime::CreateFromFormat('Y-m-d', $dateBirth);

            $newUser = new User();  
            $newUser->setNom($lastName);
            $newUser->setPrenom($firstName);
            $newUser->setLogin($login);
            $newUser->setPassword($password);
            $newUser->setDateNaissance($date);
            $newUser->setRole($role);
            $newUser->setAvatar(file_get_contents($avatar));

            $em->persist($newUser);
            $em->flush();

            $urlRedirection = '?c=user&t=list';
            header("Location: $urlRedirection");
            exit();
        }
    }
 
    #[Role('ADMIN')]
    public function edit($params){
        $id=$params["get"]["id"];
        $em=$params["em"];
       
        $queryBase= $em->createQueryBuilder();
        $queryBase ->select('d')
            ->from('Droit', 'd');

        $query = $queryBase->getQuery();
        $roles = $query->getResult();

        $user = $em->find('User', $id);

        echo $this->twig->render('user/edit_view.php', ['user' => $user, 'roles' => $roles]); 
    }

    #[Role('ADMIN')]
    public function update($params) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $params["get"]["id"];
            $em = $params["em"];
    
            // Récupérer les données du formulaire
            $lastName = $_POST["nom"]; 
            $firstName = $_POST["prenom"]; 
            $login = $_POST["login"];
            $password = $_POST["password"];
            $dateBirth = $_POST["date_naissance"];
            $roleID = $_POST["role_id"];
           
            // Vérifiez si le champ 'avatar' a été fourni dans la requête
            if (!empty($_FILES['avatar']['tmp_name'])) {
                // Un nouveau fichier a été fourni..
                $newAvatar = $_FILES['avatar']['tmp_name'];
                
                // Charger l'entité User à mettre à jour
                $newUser = $em->find('User', $id);
                // Mise à jour de l'avatar dans User
                $newUser->setAvatar(file_get_contents($newAvatar));
            }
    
            // Charger l'entité User à mettre à jour
            $newUser = $em->find('User', $id);
    
            
            // Charger l'entité role correspondante
            $role = $em->find("Droit", $roleID);

            // Mettre à jour les champs de l'entité User 
            $newUser->setNom($lastName);
            $newUser->setPrenom($firstName);
            $newUser->setLogin($login);
            $newUser->setPassword($password);
    
            // Conversion de dateTime 
            $date = \DateTime::CreateFromFormat('Y-m-d', $dateBirth);
            $newUser->setDateNaissance($date);
            $newUser->setRole($role);
            // Flush pour sauvegarder les modifications dans la base de données
            $em->flush();
    
            // Redirection vers la liste de toutes les équipes enregistrées
            $urlRedirection = "?c=user&t=list";
            header("Location: $urlRedirection");
            exit();
        }
    }
    
    #[Role('ADMIN')]
    public function delete($params){
        $id = $params["get"]["id"];
        $em = $params["em"];
    
        // Récupérer l'utilisateur
        $user = $em->find('User', $id);
    
        // Vérifier si l'utilisateur existe
        if (!$user) {
            // Gérer le cas où l'utilisateur n'existe pas
            echo "Cet utilisateur n'existe pas.";
            exit();
        }
    
        // Supprimer le joueur
        $em->remove($user);
        $em->flush();
    
        // Rediriger vers la page de l'équipe
        $urlRedirection = "?c=user&t=list";
        header("Location: $urlRedirection");
        exit();
    }
    
    
}
?>