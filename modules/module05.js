//------ mod05.js ------
function createBoard() {

	//Objeto módulo
	var boardgame;
	
	//Nombre del módulo
	boardgame.name = 'Fire in Rivershore';

	//Fondo del módulo (imagen)
	boardgame.background = 'assets/fondo.jpg';

	//Enemigos (nombre e imagen)
	boardgame.foes = [
		['Pirata','assets/foe1.png'],
		['Pirata2','assets/foe1.png'],
		['Pirata3','assets/foe1.png']
	];

	//Escenas (nombre e imagen)
	boardgame.scenes = [
		['Escena 1',''],
		['Escena 2',''],
		['Escena 3',''],
		['Escena 4',''],
		['Escena 5',''],
		['Escena 6',''],
		['Escena 7',''],
		['Escena 8','']
	];


	return boardgame;
}