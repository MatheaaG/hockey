
<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    {% block stylesheet  %}
    {% endblock %}
    <link rel="stylesheet" href="views/template/style.css"/>
    <title>LaCrosseEnFolie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Permanent+Marker&display=swap" rel="stylesheet">
<<<<<<< HEAD
    <title>LaCrosseEnFolie</title>
=======
    <link rel="icon" href="views/images/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

>>>>>>> 88aefc3820e10fc24cec266c3eef50cf10e4f89a
</head>
<body>
    <header>

        <div>
        <a href="?c=frontend&t=accueil"><img src="views/template/favicon.svg" alt="logo de la page"></a>
          <nav>
              <ul id="menu">
                <li><a href="#">Classement</a></li>
                <li><a href="?c=frontend&t=calendrier">Calendrier</a></li>
                <li><a href="?c=frontend&t=guide">Guide</a></li>
                <li><a href="#">Boutique</a></li>
              </ul>
              
<<<<<<< HEAD
              {% if session['Logged'] %}
              <a href="?c=user&t=logout" id="session" style ="text-decoration: none; color: white;">Déconnexion</a>
              {% else %}
              <a href="?c=user&t=logout" id="session" style="text-decoration: none; color: white;">Connexion</a>
              {% endif %}
=======
>>>>>>> 88aefc3820e10fc24cec266c3eef50cf10e4f89a
          </nav>
        </div>
    </header>

    
    {% block body %}
    {% endblock %}
    
    <div class="footer-basic">
            <footer>
                <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Accueil</a></li>
                    <li class="list-inline-item"><a href="#">Services</a></li>
                    <li class="list-inline-item"><a href="#">A propos</a></li>
                    <li class="list-inline-item"><a href="#">Nous contacter</a></li>
                    <li class="list-inline-item"><a href="#">Mentions légales</a></li>
                </ul>
                <p class="copyright">La Crosse En Folie © 2023</p>
            </footer>
        </div>
        
 
    
   

    {% block script %}
    {% endblock %}
</body>
</html>