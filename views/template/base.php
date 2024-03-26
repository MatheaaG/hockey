
<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    {% block stylesheet  %}
    
    {% endblock %}
    <link rel="stylesheet" href="views/template/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>LaCrosseEnFolie</title>
</head>
<body>
    <header>

        <div>
          <img src="views/template/favicon.svg" alt="logo de la page">
          <nav>
              <ul id="menu">
                <li><a href="?c=calendrier&t=list">Calendrier</a></li>
                <li><a href="?c=equipe&t=list">Equipes</a></li>
                <li><a href="?c=joueur&t=list">Joueurs</a></li>
                <li><a href="?c=ville&t=read">Villes</a></li>
                <li><a href="?c=user&t=list">Utilisateurs</a></li>
              </ul>
              
              {% if session['Logged'] %}
              <a href="?c=user&t=logout" id="session" style ="text-decoration: none; color: white;">Déconnexion</a>
              {% else %}
              <a href="?c=user&t=logout" id="session" style="text-decoration: none; color: white;">Connexion</a>
              {% endif %}
          </nav>
        </div>
    </header>
   
    {% block body %}
    {% endblock %}

    {% block script %}
    {% endblock %}
</body>
</html>