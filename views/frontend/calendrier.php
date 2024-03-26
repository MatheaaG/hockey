{% extends "template/base.php" %}

{% block stylesheet %}
<link rel="stylesheet" href="views/frontend/css/calendrier.css"/>
{% endblock %}

{% block body %}
<div class="container"></div>

{% endblock %}

{% block script %}
<script>
$(document).ready(function() {
    // Récupération du modèle HTML une seule fois
    fetch('views/frontend/fichier.html')
        .then(response => response.text())
        .then(function(res){
            // Utilisation du modèle HTML récupéré
            const response = $(res);
            const container = $('.container');

            // Ajout du modèle HTML à la page
            container.html(response);

            // Enlever le modèle HTML initial de la page
            response.remove();

            $.ajax({
                type: 'POST',
                url: 'http://195.154.118.169/mathea/hockey/cli-config.php?c=calendrier&t=api&nb=4',
                success: function(datas) {
                    datas = JSON.parse(datas);

                    for (let i = 0; i < 4; i++) {
                        const data = datas[i];
                        const dt = new Date(data.Date.date); 
                        const options = {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                        };

                        // Construction dynamique du modèle HTML pour chaque match
                        let matchHTML = response.clone();

                        // Remplissage des données du match dans le modèle HTML cloné
                        matchHTML.find('#equipe1').attr('src', 'data:image/png;base64,' + data.Logo[0]);
                        matchHTML.find('.nomEquipe1').html(data.Equipes[0]);
                        matchHTML.find('#equipe2').attr('src', 'data:image/png;base64,' + data.Logo[1]);
                        matchHTML.find('.nomEquipe2').html(data.Equipes[1]);
                        matchHTML.find('.date').html(dt.toLocaleDateString('fr-FR', options));
                        matchHTML.find('.heure').html(dt.toLocaleTimeString('fr-FR'));
                        matchHTML.find('#score1').html(data.Score[0]);
                        matchHTML.find('#score2').html(data.Score[1]);

                        // Ajout du modèle HTML du match à la container
                        container.append(matchHTML);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(status, error);
                }
            });
        });
});


      
    /*
    $.ajax({
        type: 'POST',
        url: 'http://195.154.118.169/mathea/hockey/cli-config.php?c=calendrier&t=api&nb=4',
        success: function(datas) {
            datas = JSON.parse(datas);
            const container = $('.container');
            //nbMatch = datas.length;
            //console.log(nbMatch);
            //nbPages = nbMatch/4;
           // console.log(nbPages);


            for (let i = 0; i < 4; i++) {
                data = datas[i];
           
               
                
                dt = new Date(data.Date.date); 
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                }            

                // Clone the cadre template
                const cadre = $('.cadre').first().clone();

                // Fill data into the clone
                cadre.find('#equipe1').attr('src', 'data:image/png;base64,' + data.Logo[0]);
                cadre.find('.nomEquipe1').html(data.Equipes[0]);
                cadre.find('#equipe2').attr('src', 'data:image/png;base64,' + data.Logo[1]);
                cadre.find('.nomEquipe2').html(data.Equipes[1]);
                cadre.find('.date').html(dt.toLocaleDateString('fr-FR', options));
                cadre.find('.heure').html(dt.toLocaleTimeString('fr-FR'));
                cadre.find('#score1').html(data.Score[0]);
                cadre.find('#score2').html(data.Score[1]);

                // Show the cadre
                cadre.css('display', 'block');

                // Append the filled clone to the container
                container.append(cadre);
            }
        },

        error: function(xhr, status, error) {
            console.error(status, error);
        }
    
    })
  
});*/


</script>
{% endblock %}
