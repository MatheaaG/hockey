{% extends "template/base.php" %}

{% block stylesheet %}
<link rel="stylesheet" href="views/frontend/css/new.css"/>


{% endblock %}

{% block body %}
<div class="container">

    <div class="row">
       
        <div id="col1" class="col-12 col-sm-6  cadre">
            
            <div class="date">17 juillet 2024</div>
            <div class="heure">14h00</div>

            <div class="match">
                
                <div class="equipes">
                    <div class="equipe1">
                        <img src="views/images/logo_rapaces.png" />
                        <div class="nomEquipe1"></div>
                    </div>
                    <div class="score">
                        <p><span id="score1"></span>
                        3-1
                        <span id="score2"></span></p>
                    </div>
                    <div class="equipe2">
                        <img src="views/images/nhl.jpg" />
                        <div class="nomEquipe2"></div>
                    </div>
                </div>

            </div>
            <div class="button_detail">
                <button>À propos</button>
            </div>
        </div>
    
        <div id="col1" class="col-12 col-sm-6  cadre">
            <div class="date">17 juillet 2024</div>
            <div class="heure">14h00</div>

            <div class="match">

                <div class="equipes">
                    <div class="equipe1">
                        <img src="views/images/logo_rapaces.png" />
                        <div class="nomEquipe1"></div>
                    </div>
                    <div class="score">
                        <p><span id="score1"></span>
                        3-1
                        <span id="score2"></span></p>
                    </div>
                    <div class="equipe2">
                        <img src="views/images/nhl.jpg" />
                        <div class="nomEquipe2"></div>
                    </div>
                </div>
            </div>
            <div class="button_detail">
            <button>À propos</button>
            </div>
        </div>
        
    </div>

   
  
</div>

{% endblock %}