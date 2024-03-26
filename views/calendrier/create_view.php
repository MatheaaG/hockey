
{% extends "/template/base.php" %}
{% block stylesheet %}
<link rel="stylesheet" href="views/calendrier/style.css"/>
{% endblock %}

{% block body %}
<div id="container">
    <form action="?c=calendrier&t=insert" method="post" enctype="multipart/form-data">
    <h1>Créer un match</h1>
    Sélectionner l'équipe à domicile :
      <select name="equipe1_id">
        {% for equipe in equipes %}
          <option value={{equipe.id}}>{{equipe.nameTeam}}</option>
        {% endfor %}
      </select>
    Sélectionner l'équipe exterieur :
      <select name="equipe2_id">
        {% for equipe in equipes %}
        <option value={{equipe.id}}>{{equipe.nameTeam}}</option>
        {% endfor %}
      </select>
    Sélectionnez la ville : 
      <select name="ville_id">
        {% for ville in villes %}
        <option value={{ville.id}}>{{ville.nameCity}}</option>
        {% endfor %}
      </select>
     
    Date et Heure de la rencontre : <input type="datetime-local" id="dateTime" name="dateTime" required />
    Prix : <input type="number" id="prix" name="prix"/>
    Score équipe 1<input type="number" id="score1" name="score1"></input>
    Score équipe 2<input type="number" id="score2" name="score2"></input>
    <input type="submit" value='Enregistrer' >
</form>
</div>
{% endblock %}
