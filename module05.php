<!doctype html> 
<html lang="en"> 
<head> 
	<meta charset="UTF-8" />
	<title>Hero Kids</title>
    <script src="libraries/jquery-3.3.1.min.js"></script>
    <script src="libraries/contextMenu.js"></script>
    <script src="libraries/phaser.min.js"></script>
    <script src="libraries/Phasetips.js"></script>
    <script src="libraries/Dice.js"></script>
    <script src="modules/module05.js"></script>
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<style>
	canvas {   display : block;   margin : auto;}
	body {
		background-image: url("resources/fondo.jpg");
		 background-repeat: no-repeat;
		 background-size: cover;
	}
	</style>
</head>
<body>
<script type="text/javascript">
var gamewidth = window.innerWidth;
var gameheight = window.innerHeight;    
var game = new Phaser.Game(1000, 700, Phaser.AUTO, '', { preload: preload, create: create, update: update },true);
var currentMap=0;
var maps = ["map01","map02","map03","map04"];
var mapName = ["Encuentro 1: Fuga de la prisión!","Encuentro 2: Adelante, ARRR!","Encuentro 3: La cubierta superior!","Encuentro 4: Hacia el castillo de popARRRR!"];
var mapa;
var nombreEncuentro;
var grupoMapa;
var grupoHeroes;
var grupoEnemigos;
var diceHidden = true
var dicePanel;
var dado1, dado2, dado3, dado4, dado5, dado6;

function preload() {
	window.addEventListener('resize', function () {  
		game.scale.refresh();
	});
	game.scale.fullScreenScaleMode = Phaser.ScaleManager.SHOW_ALL;
	game.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;
	game.scale.refresh();
    //Carga las imágenes
	game.load.image('map01', 'assets/mod4map01.png');
	game.load.image('map02', 'assets/mod4map02.png');
	game.load.image('map03', 'assets/mod4map03.png');
	game.load.image('map04', 'assets/mod4map04.png');
	game.load.image('foe5', 'assets/foe5.png');
	game.load.image('foe6', 'assets/foe6.png');
	game.load.image('foe7', 'assets/foe7.png');
	game.load.image('foe8', 'assets/foe8.png');
	game.load.image('foe9', 'assets/foe9.png');
	game.load.image('foe10', 'assets/foe10.png');
    game.load.image('vida1_1', 'assets/vida1_1.png');
    game.load.image('vida2_1', 'assets/vida2_1.png');
    game.load.image('vida2_2', 'assets/vida2_2.png');
    game.load.image('vida3_1', 'assets/vida3_1.png');
    game.load.image('vida3_2', 'assets/vida3_2.png');
    game.load.image('vida3_3', 'assets/vida3_3.png');
    game.load.image('vida4_1', 'assets/vida4_1.png');
    game.load.image('vida4_2', 'assets/vida4_2.png');
    game.load.image('vida4_3', 'assets/vida4_3.png');
    game.load.image('vida4_4', 'assets/vida4_4.png');
    game.load.image('skull', 'assets/skull.png');
	game.load.image('healer', 'assets/healer.png');
	game.load.image('knight', 'assets/knight.png');
	game.load.image('pet1', 'assets/pet1.png');
	game.load.image('pet2', 'assets/pet2.png');
	game.load.image('btn-relfoes', 'assets/btn-mas.png');
	game.load.image('btn-next', 'assets/btn-next.png');
	game.load.image('btn-prev', 'assets/btn-prev.png');
	game.load.image('btn-mas', 'assets/btn_mas.png');
	game.load.image('btn-menos', 'assets/btn_menos.png');
	game.load.image('btn-dado', 'assets/btn_dado.png');
	game.load.image('dicepanel-bg', 'assets/dicepanel-bg.png');
	game.load.spritesheet('dicered', 'assets/diceRed.png', 64, 64);
	game.load.spritesheet('diceblue', 'assets/diceBlue.png', 64, 64);
    game.load.script("BlurX", 'assets/BlurX.js');
    game.load.script("BlurY", 'assets/BlurY.js');
    game.load.image('fondo', 'assets/fondo2.jpg')
}

function create() {
    
    var menu = [{
        name: 'create',
        img: 'assets/create.png',
        title: 'create button',
        fun: function () {
            alert('i am add button')
        }
    }, {
        name: 'update',
        img: 'assets/update.png',
        title: 'update button',
        fun: function () {
            alert('i am update button')
        }
    }, {
        name: 'delete',
        img: 'assets/delete.png',
        title: 'delete button',
        fun: function () {
            alert('i am delete button')
        }
    }];
    
    game.canvas.oncontextmenu = function (e) { e.preventDefault(); }
    
    grupoFondo = game.add.group();
    grupoMapa = game.add.group();
    grupoHeroes = game.add.group();
    grupoEnemigos = game.add.group();
    
    //game.stage.backgroundColor = "#4488AA";
    //var fondo = game.add.sprite(0, 0, 'fondo');
    //fondo.width = game.world.width;
    //fondo.height = game.world.height;
    //grupoFondo.add(fondo);
    
    //nombre del mapa
    var style = { font: "28px Arial", fill: "#ffffff", align: "center" };
    nombreEncuentro = game.add.text(110,600-5, mapName[0], style);
    nombreEncuentro.setShadow(2, 2, 'rgba(0, 0, 0, 0.5)', 2);
    grupoMapa.add(nombreEncuentro);
    
    //Añadir mapa
	mapa = game.add.sprite(112, 0, maps[currentMap]);
    grupoMapa.add(mapa);
    
    //Añadir botones
	var botonSig = game.add.sprite(900-32,600-5,'btn-next'); //boton de siguiente encuentro
    botonSig.inputEnabled = true;
    botonSig.input.useHandCursor = true;
    botonSig.events.onInputDown.add(nextMap, this);
	var botonAnt = game.add.sprite(900-69,600-5,'btn-prev'); //boton de encuentro anterior
    botonAnt.inputEnabled = true;
    botonAnt.input.useHandCursor = true;
    botonAnt.events.onInputDown.add(prevMap, this);
	var botonRecarga = game.add.sprite(900-106,600-5,'btn-relfoes'); //boton de resetear enemigos
    botonRecarga.inputEnabled = true;
    botonRecarga.input.useHandCursor = true;
    botonRecarga.events.onInputDown.add(creaEnemigos, this);
    var botonDado = game.add.sprite(900-143,600-5,'btn-dado'); //boton de ventana dados
    botonDado.inputEnabled = true;
    botonDado.input.useHandCursor = true;
    botonDado.events.onInputDown.add(ventanaDado, this);
    
    //Añadir personajes
    var healer = addCharacter('healer', 5, 5, 3, 'heroes');	
	var healerTip = new Phasetips(game, {targetObject: healer, context: "Sanadora\n\nPuntos de Vida: "+healer.vida+"/"+healer.maxvida+"\nAtaque: 1\nAtaque a distancia: 2\nDefensa: 1\nHab. Esp: Inteligencia"})
    
    var knight = addCharacter('knight', 5, 74, 3, 'heroes');
	var knightTip = new Phasetips(game, {targetObject: knight, context: "Caballero\n\nPuntos de Vida: "+knight.vida+"/"+knight.maxvida+"\nAtaque: 1\nDefensa: 3\nHab. Esp: Fuerza"})
    
    //Añadir mascotas
    var dragon = addCharacter('pet1', 5, 143, 3, 'heroes');
    var unicorn = addCharacter('pet2', 5, 212, 3, 'heroes');
    
    creaEnemigos();
    
    var diceGroup1 = game.add.group();
    dado1 = new Dice(game, 40,400, "blue");
    dado1.events.onDragStop.add(function(){diceGroup1.callAll("roll", null);},this);
    diceGroup1.add(dado1);
    
    var diceGroup2 = game.add.group();
    dado2 = new Dice(game, 40,480, "blue");
    dado2.events.onDragStop.add(function(){diceGroup2.callAll("roll", null);},this);
    diceGroup2.add(dado2);
    
    var diceGroup3 = game.add.group();
    dado3 = new Dice(game, 40,560, "blue");
    dado3.events.onDragStop.add(function(){diceGroup3.callAll("roll", null);},this);
    diceGroup3.add(dado3);
    
    var diceGroup4 = game.add.group();
    dado4 = new Dice(game, 948,400, "red");
    dado4.events.onDragStop.add(function(){diceGroup4.callAll("roll", null);},this);
    diceGroup4.add(dado4);
    
    var diceGroup5 = game.add.group();
    dado5 = new Dice(game, 948,480, "red");
    dado5.events.onDragStop.add(function(){diceGroup5.callAll("roll", null);},this);
    diceGroup5.add(dado5);
    
    var diceGroup6 = game.add.group();
    dado6 = new Dice(game, 948,560, "red");
    dado6.events.onDragStop.add(function(){diceGroup6.callAll("roll", null);},this);
    diceGroup6.add(dado6);
    
    //oculta ventana dado
    game.input.mouse.capture = true;
}

function update() {
    
}
  
function contexto() {
    if(game.input.activePointer.rightButton.isDown) {
        //alert("click derecho");       
    }
}
    
function creaEnemigos() {
    //Vacia grupo enemigos
    grupoEnemigos.callAll('kill');
    
     //Añadir enemigos
    for (x=0; x<10; x++) {
        var foe = addCharacter('foe5', 915, 5, 3, 'foes'); //lobos
        var foeTip = new Phasetips(game, {targetObject: foe, context: "Capitán Pirata\n\nPuntos de Vida: "+foe.vida+"/"+foe.maxvida+"\nAtaque: 2\nDefensa: 2\nHab. Esp: Líder - Los aliados adyancentes ganan 1 dado de ataque"})
        var foe2 = addCharacter('foe6', 915, 73, 3, 'foes'); //arañas
        var foe2Tip = new Phasetips(game, {targetObject: foe2, context: "Capitán Fantasmal\n\nPuntos de Vida: "+foe2.vida+"/"+foe2.maxvida+"\nAtaque: 2\nAtaque a distancia: 1\nDefensa: 2\nHab. Esp: Resucitar - Puede resucitar 1 aliado al recibir daño"})
        var foe3 = addCharacter('foe8', 915, 141, 2, 'foes'); //arañas
        var foe3Tip = new Phasetips(game, {targetObject: foe3, context: "Espadachín Pirata\n\nPuntos de Vida: "+foe3.vida+"/"+foe3.maxvida+"\nAtaque: 2\nDefensa: 2\nHab. Esp: Tímido - Tu ataque baja en 1 mientras luchas"})
        var foe4 = addCharacter('foe9', 915, 209, 2, 'foes'); //arañas
        var foe4Tip = new Phasetips(game, {targetObject: foe4, context: "Esqueleto Arquero\n\nPuntos de Vida: "+foe4.vida+"/"+foe4.maxvida+"\nAtaque a distancia: 2\nDefensa: 1\nHab. Esp: Frágil - Tu ataque baja en 1 cuando estás dañado"})
        var foe5 = addCharacter('foe10', 915, 277, 2, 'foes'); //arañas
        var foe5Tip = new Phasetips(game, {targetObject: foe5, context: "Esqueleto Espadachín\n\nPuntos de Vida: "+foe5.vida+"/"+foe5.maxvida+"\nAtaque: 2\nDefensa: 1\nHab. Esp: Frágil - Tu ataque baja en 1 cuando estás dañado"})
    }
}

//Carga el siguiente mapa
function nextMap() {
	currentMap = currentMap + 1;
	if (currentMap == maps.length) {
		currentMap=0;
	}
	//poner en foco el mapa actual o cargar de nuevo
    mapa.loadTexture(maps[currentMap]);
    nombreEncuentro.text = mapName[currentMap];
}

//Carga el mapa anterior
function prevMap() {
	currentMap = currentMap - 1;
	if (currentMap < 0) {
		currentMap= maps.length - 1;
	}
    mapa.loadTexture(maps[currentMap]);
    nombreEncuentro.text = mapName[currentMap];
}
    
function restaVida() {
    this.personaje.vida--;
    if (this.personaje.vida <= 0) {
        //matar personaje
        this.personaje.vida=0;
        this.personaje.marcador.loadTexture('skull');
    } else {
        this.personaje.marcador.loadTexture('vida' + this.personaje.maxvida + '_' + this.personaje.vida);
    }
    
}
    
function sumaVida() {
    this.personaje.vida++;
    if(this.personaje.vida > this.personaje.maxvida) {
        this.personaje.vida = this.personaje.maxvida;
    }
    
    this.personaje.marcador.loadTexture('vida' + this.personaje.maxvida + '_' + this.personaje.vida);
}
    
function ventanaDado() {
    //resetear posicion dados
    dado1.position.x=40;
    dado1.position.y=400;
    dado2.position.x=40;
    dado2.position.y=480;
    dado3.position.x=40;
    dado3.position.y=560;
    dado4.position.x=948;
    dado4.position.y=400;
    dado5.position.x=948;
    dado5.position.y=480;
    dado6.position.x=948;
    dado6.position.y=560;
}

function addCharacter(type, posX, posY, hp, faccion) {
    
	//Añadir personajes
	var character = game.add.sprite(posX, posY, type);
	character.inputEnabled = true;
	character.input.enableDrag(true);
    character.input.useHandCursor = true;
    character.maxvida=hp;
    character.vida=hp;
    character.events.onInputDown.add(contexto,this);
    character.marcador = game.add.sprite(0,0,'vida'+hp+'_'+hp);
    character.botonmenos = game.add.sprite(1,55,'btn-menos');
    character.botonmenos.inputEnabled = true;
    character.botonmenos.events.onInputDown.add(restaVida, {personaje: character});
    character.botonmas = game.add.sprite(55,55,'btn-mas');
    character.botonmas.inputEnabled = true;
    character.botonmas.events.onInputDown.add(sumaVida, {personaje: character});
    character.addChild(character.marcador);
    character.addChild(character.botonmenos);
    character.addChild(character.botonmas);
    if (faccion=="heroes") {
        grupoHeroes.add(character);
    } else if (faccion=="foes") {
        grupoEnemigos.add(character);
    }
    return character;
}
</script>
</body>
</html>