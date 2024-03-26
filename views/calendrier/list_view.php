
{% extends "template/base.php" %}
	{% block body %}
    
    <table id='tab' class="dt-body-center">
        <thead> 
        <tr><th>Equipe 1</th><th>Equipe 2</th><th>Ville</th><th> Date & heure </th><th>Prix</th><th>Score 1</th><th>Score 2</th><th>Editer</th><th>Supprimer</th></tr> 
        </thead>
        <tbody> 
			{% for calendrier in calendriers %}
            <tr>
                <td>{{calendrier.equipe1.nameTeam}}</td>
                <td>{{calendrier.equipe2.nameTeam}}</td>
                <td>{{calendrier.ville}}</td>
				<td>{{calendrier.dateTime|format_datetime(locale='fr')}}</td>
                <!--<td>{{calendrier.dateTime|format_datetime(locale='fr')}} ou {{calendrier.dateTime|format_datetime('none', 'short', locale='fr')}}</td>
                <td>{{calendrier.dateTime|date("H:m")}}</td>-->
                <td>{{calendrier.prix}}</td>
				<td>{{calendrier.score1}}</td>
				<td>{{calendrier.score2}}</td>
				<td><a href="?c=calendrier&t=edit&id={{calendrier.id}}"><button id='edit'>Editer</button></a></td>
				<td><a href="?c=calendrier&t=delete&id={{calendrier.id}}"><button id="delete">Supprimer</button></a></td>
			</tr>
            {% endfor %}
        </tbody> 	
    </table>

	<div class="create">
	<button id="create"><a href="?c=calendrier&t=create">Create</a></button>
	</div>
	
	{% endblock %}

	{% block script %}
	<script>
	/*global $*/
	$(document).ready(function () {
		$('#tab').DataTable({
			columnDefs: [
				{
					className: 'dt-body-right'
				}
			]
		});
	});
	</script>
	{% endblock %}




