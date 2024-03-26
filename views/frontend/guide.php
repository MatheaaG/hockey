{% extends "template/base.php" %}

{% block stylesheet %}
<link rel="stylesheet" href="views/frontend/css/guide.css"/>
{% endblock %}

{% block body %}
<h2>Composition d'une équipe</h2>
<p>Les équipes sont composées de 20 joueurs maximum et de 2 gardiens. Sur la glace, il y a 5 joueurs de champs et un gardien qui peuvent jouer simultanément sur la glace.</br>
Une équipe est habituellement constituée de 4 blocs (aussi appelés lignes) composés de 5 joueurs chacun (3 attaquants et 2 défenseurs) qui se relaient sur la glace tout au long du match (changement à la volée ou alors sur arrêt de jeu). 
</p>
<canvas id="canvas" width="1500" height="300" ></canvas>
<div>
<button onclick="clearInterval(stop);">Stop</button>
</div>
{% endblock %}


{% block script %}

<script>
let imgPlayerDef1 = new Image();
let imgPlayerDef2 = new Image();
let imgPlayerAtq1 = new Image();
let imgPlayerAtq2 = new Image();
let imgPlayerAtq3 = new Image();
let imgGardien    = new Image();
let imgGoal       = new Image();
let playerX=600;
let playerY=100;
let player2X=840;
let player2Y=100;
let player3X=300;
let player3Y=150;
let player4X=1200;
let player4Y=150;
let player5X=700;
let player5Y=150;
let goalX = 700;
let goalY = 40;
let gardienX = 717;
let gardienY = 60;
let flagInv1 = false;
let flagInv2 = false;
let flagInv3 = false;
let flagInv4 = false;
let flagInv5 = false;

function init() {
  imgPlayerDef1.src = "views/images/joueur.png";
  imgPlayerDef2.src = "views/images/joueur.png";
  imgPlayerAtq1.src = "views/images/joueur.png";
  imgPlayerAtq2.src = "views/images/joueur.png";
  imgPlayerAtq3.src ="views/images/joueur.png";
  imgGardien.src    = "views/images/gardien.png";
  imgGoal.src       = "views/images/but.png";
  window.requestAnimationFrame(draw);
}

function drawPlayer1(ctx) {
  ctx.drawImage(imgPlayerDef1, playerX, playerY, 100, 100);
  if (flagInv1) playerX -= 10;
  else playerX += 10;
  if (playerX > 540 && !flagInv1) flagInv1 = true;
  if (playerX < 400 && flagInv1) flagInv1 = false;
  }

function drawPlayer2(ctx) {
  ctx.drawImage(imgPlayerDef2, player2X, player2Y, 100, 100);
  if (flagInv2) player2X -= 10;
  else player2X += 10;
  if (player2X > 1040 && !flagInv2) flagInv2 = true;
  if (player2X < 900 && flagInv2) flagInv2 = false;
}

function drawPlayer3(ctx) {
  ctx.drawImage(imgPlayerAtq1, player3X, player3Y, 100, 100);
  if (flagInv3) player3X -= 10;
  else player3X += 10;
  if (player3X > 300 && !flagInv3) flagInv3 = true;
  if (player3X < 200 && flagInv3) flagInv3 = false;
}

function drawPlayer4(ctx) {
  ctx.drawImage(imgPlayerAtq2, player4X, player4Y, 100, 100);
  if (flagInv4) player4X -= 10;
  else player4X += 10;
  if (player4X > 1300 && !flagInv4) flagInv4 = true;
  if (player4X < 1100 && flagInv4) flagInv4 = false;
}

function drawPlayer5(ctx) {
  ctx.drawImage(imgPlayerAtq3, player5X, player5Y, 100, 100);
  if (flagInv5) player5X -= 10;
  else player5X += 10;
  if (player5X > 800 && !flagInv5) flagInv5 = true;
  if (player5X < 600 && flagInv5) flagInv5 = false;
}

function draw() {
  
  let ctx = document.getElementById("canvas").getContext("2d");

  ctx.globalCompositeOperation = "destination-over";
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  drawPlayer1(ctx);
  drawPlayer2(ctx);
  drawPlayer3(ctx);
  drawPlayer4(ctx);
  drawPlayer5(ctx);

  ctx.drawImage(imgGardien, gardienX, gardienY, 90,90);
 
  ctx.drawImage(imgGoal, goalX, goalY, 130, 140);
  //window.requestAnimationFrame(draw);
}
var stop = setInterval(draw,100);
init();

</script>
{% endblock %}

