<?php

//Criacao da classe rover, para criação de nosso objeto
/*
Entendendo o basico do exercicio
O intuito do programa é movimentar um objeto em um plano cartesiano, movimentando entre x e y de acordo para onde o objeto esta voltado
Imagine os 4 pontos cardeais, Norte, Sul, Leste Oeste, a partir de agora cada um vai receber um grau
	Norte = 0
	Sul = 180
	Leste = 90
	Oeste = 270
Tendo estes valores em mente, iremos inciar o rover, ele aceita 3 tipos de instruçao, L,R,M
	L = Left -> Esquerda (-90 graus)
	R = Right -> Direta (+90 graus)
	M = Move -> Movimentar (Movimentar)
L, R, são reponsaveis por girar o rover e M, para movimentar, porém a peculiaridade em questão são os métodos, Direita e Esquerda
Ou seja, Direita adiciona mais 90 graus, e esquerda retira 90 graus, visto isso se temos um objeto ao sul, e viramos a esquerda, ele vai para o leste, pois:
Sul  = 180 - 90 = 90, o valor de leste é 90
*/
class Rover{
	//atributos de nossa classe
	//x e y, são posicoes do plano cartesiano
	private $x;
	private $y;
	//face e para onde o rover vai estar voltado, norte, sul, leste ou oeste
	private $face;
	//posicoes, serve apenas para validarmos, se o usuario colocou, uma posicao valida, norte, sul, leste ou oeste
	//setamos as posicoes validas
	private $posicoes = array("N", "L", "S", "O");
	//metodos do rover
	//construtor do objeto, seta os parametros automaticamente
	//os 3 atributos tem valores padrão, ou seja, caso quando instanciarmos, não passarmos as posições, o padrão será x-> 0, y->0, face->norte
	public function __construct($x = 0, $y =0, $face = "N"){
		//o this referencia a um proprio atributo da classe, entao checamos se o numero é um inteiro, se sim, atribuimos a x e y, se não, valor padrao de 0
		if(is_int($x)){
			$this->x = $x;
		}else{
			$this->x = 0;
		}
		if(is_int($y)){
			$this->y = $y;
		}else{
			$this->y = 0;
		}
		//aqui checamos se a face esta setada para um posição valida, ou seja, se for, norte, sul, leste, ou oeste, ele seta, se não, seta norte, por padrao
		if(in_array($face, $this->posicoes)){
			$this->face = $face;
		}else{
			$this->face = "N";
		}
	}
	//metodo move, movimentar o rover para onde sua face esta voltada, ou seja, se ele esta em 0,0 e para norte, ele andara no eixo X para cima, se ele esta em 0,0 para sul, andara no eixo X para baixo
	function movimentar($movimentos){
		//percorre string e executa os movimentos
		for($i=0; $i<strlen($movimentos);$i++){
			switch ($movimentos[$i]) {
				case 'L':
					//funcao para esquerda
					$this->esquerda();
				break;
				case 'R':
					//funcao para direita
					$this->direita();
				break;
				case 'M':
					//funcao move
					$this->mover();
				break;
				default:
					echo "Comando inexistente!";
				break;
			//fimswitch
			}
		//fimfor
		}
	}
	//funcao esquerda
	function esquerda(){
		//gira o rover
		switch($this->face){
			//caso for norte, vire para oeste
			case "N":
				$this->face="O";
			break;
			//caso for sul, vire para o leste
			case "S":
				$this->face="L";
			break;
			//caso for oeste, vire para o sul
			case "O":
				$this->face="S";
			break;
			//caso for leste, vire para o norte
			case "L":
				$this->face="N";
			break;
		}
	}
	//funcao direita
	function direita(){
		//gira o rover
		switch($this->face){
			case "N":
				$this->face="L";
			break;
			case "S":
				$this->face="O";
			break;
			case "E":
				$this->face="S";
			break;
			case "O":
				$this->face="N";
			break;
		}
	}
	//funcao mover
	function mover(){
		//move o rover uma casa a frente para onde sua face esta voltada
		switch($this->face){
			case "N":
				$this->y++;
			break;
			case "S":
				$this->y--;
			break;
			case "E":
				$this->n++;
			break;
			case "W":
				$this->n--;
			break;
		}
	}
	//mostra a posicao atual do rover
	function imprimir(){
		$array = array("x" => $this->x, "y" => $this->y,"f" => $this->face);
		echo json_encode($array);
		//echo "X: (".$this->x.") - Y: (".$this->y.") Face - >".$this->face."<br>";
	}

	function __destruct(){

	}

}
$x = intval($_POST["x"]);
$y = intval($_POST["y"]);
$face = strtoupper($_POST["face"]);
$movimentar = strtoupper($_POST["movimentar"]);
$rover = new Rover($x, $y, $face);
//Executa os comandos de movimentação
$rover->movimentar($movimentar);
//imprime sua posição
$rover->imprimir();

