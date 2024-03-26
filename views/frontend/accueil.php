
{% extends "template/base.php" %}

{% block stylesheet %}
<link rel="stylesheet" href="views/frontend/css/accueil.css"/>


{% endblock %}

{% block body %}
    {# <link rel="icon" href="../images/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Permanent+Marker&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
        #}
        <div class="container-md">

                    <div class="menu">
                        <div class="actualite">
                        <h2><a href="?c=frontend&t=guide" style="text-decoration:none">Classement</a></h2>
                        </div>
                    
                        <div class="match">
                        <h2><a href="?c=frontend&t=calendrier" style="text-decoration:none">Calendrier</a></h2>
                        </div>
                
                        <div class="guide">
                            <h2><a href="?c=frontend&t=guide" style="text-decoration:none">Guide</a></h2>
                        </div>
                    
                        <div class="boutique">
                            <h2><a href="?c=frontend&t=guide" style="text-decoration:none">Boutique</a></h2>
                        </div>
                    </div>
        </div>

        {% endblock %}
