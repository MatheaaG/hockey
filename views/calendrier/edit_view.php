
{% extends "template/base.php" %}
{% block stylesheet %}
<link rel="stylesheet" href="views/calendrier/style.css"/>
{% endblock %}

{% block body %}
<div id="container">
    <form action="?c=calendrier&t=update&id={{calendrier.id}}" method="post" enctype="multipart/form-data">
        <h1>Modifier la rencontre</h1>
        Sélectionnez l'équipe à domicile : 
        <select name="equipe1_id">
                {% for equipe in equipes %}
                    <option value="{{ equipe.id }}" {% if equipe.id == calendrier.equipe1.id %} selected {% endif %}>
                        {{ equipe.nameTeam }}
                    </option>
                {% endfor %}
        </select>
        Sélectionnez l'équipe exterieur : 
        <select name="equipe2_id">
                {% for equipe in equipes %}
                    <option value="{{ equipe.id }}" {% if equipe.id == calendrier.equipe2.id %} selected {% endif %}>
                        {{ equipe.nameTeam }}
                    </option>
                {% endfor %}
        </select>
        Sélectionnez la ville : 
        <select name="ville_id">
                {% for ville in villes %}
                <option value="{{ville.id}}">{{ville.nameCity}}</option>
                {% endfor %}
        </select>
        Date et Heure de la rencontre :
        {% if calendrier.dateTime %}
            {% set formattedDateTime = calendrier.dateTime|date('Y-m-d\\TH:i:s') %}
            <input type="datetime-local" id="dateTime" name="dateTime" value="{{ formattedDateTime }}" />
        {% else %}
            <input type="datetime-local" id="dateTime" name="dateTime" />
        {% endif %}
        Prix : <input type="number" id="prix" name="prix" value="{{calendrier.prix}}"/>
        Score équipe 1 : <input type="number" id="score1" name="score1" value="{{calendrier.score1}}"/>
        Score équipe 2 : <input type="number" id="score2" name="score2" value="{{calendrier.score2}}"/>
        <input type="submit" value='Modifier' >
    </form>
</div>

{% endblock %}
