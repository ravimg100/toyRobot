<?php

$directions = ['EAST','WEST','NORTH', 'SOUTH'];

$leftRightDirections = [
	"EAST" => [
		"LEFT" => "NORTH",
		"RIGHT" => "SOUTH"
	],
	"WEST" => [
		"LEFT" => "SOUTH",
		"RIGHT" => "NORTH"
	],
	"NORTH" => [
		"LEFT" => "WEST",
		"RIGHT" => "EAST"
	],
	"SOUTH" => [
		"LEFT" => "EAST",
		"RIGHT" => "WEST"
	]
];

$isPlaced = false;
$x = 0;
$y = 0;
$f = '';
$height = 5;
$width = 5;
$error = false;

function place($x_axis, $y_axis, $direction){
	global $directions;
	global $x;
	global $y;
	global $f;
	global $isPlaced;
	global $error;
	
	if($x_axis < 0 and $y_axis < 0 and !in_array($direction, $directions)){
		$error = true;
		echo "\n You must provide a command to place the robot \n";
		return;
	}
		
	$x = $x_axis;
	$y = $y_axis;
	$f = $direction;
	$isPlaced = true;
}

function left(){

	global $f;
	global $leftRightDirections;
	
	$f = $leftRightDirections[$f]['LEFT'];
}

function right(){

	global $f;
	global $leftRightDirections;
	
	$f = $leftRightDirections[$f]['RIGHT'];
}


function move(){
	global $x;
	global $y;
	global $f;
	global $isPlaced;
	global $height;
	global $width;
	global $error;
	
	if(!$isPlaced){
		$error = true;
		echo "\n Cannot move, robot not yet placed \n";	
		return;
	}
		
	if($y == $height || $x == $width){
		$error = true;
		
		if($y == $height){
			echo "\n Cannot move further, reached north boundary \n";
		}elseif($y == -$height){
			echo "\n Cannot move further, reached south boundary \n";
		}elseif($x == $width){
			echo "\n Cannot move further, reached east boundary \n";
		}else if($x == -$width){
			echo "\n Cannot move further, reached west boundary \n";
		} 
		
		report();
		return;
	}
		
	switch($f){
		case "NORTH":
			$y+= 1;
			break;
		case "SOUTH":
			$y-= 1;
			break;
		case "EAST":
			$x+=1;
			break;
		case "WEST":
			$x-=1;
			break;
	}
	return;
}

function report(){
	global $x;
	global $y;
	global $f;
	echo($x.",".$y.",".$f."\n");
	$isPlaced = false;
}

function simulate($filePath){
	
	global $x;
	global $y;
	global $f;
	global $error;
	
	$file_path = $filePath;

	if(empty($file_path)){
		print("No file provided");
		return;
	}

	$file = fopen($file_path,"r");

	$rowCount = 0;
	if(!empty($file)){
		while (($row = fgetcsv($file, 1000, ",")) != FALSE)
		{
			if($rowCount >= 0 && !$error){
				if(empty($row[0]) && empty($row[1])){
					print("\n File is empty \n");
					return;
				}
				$actionDetails = explode(' ',$row[0]);
				$action = $actionDetails[0];
				
				switch($action){
					case "PLACE":
						$placement = explode(',',$actionDetails[1]);
						if(!empty($placement)){
							place($placement[0], $placement[1], $placement[2]);
						}
						break;
					case "MOVE":
						move($x, $y, $f);
						break;
					case "LEFT":
						left();
						break;
					case "RIGHT":
						right();
						break;
					case "REPORT":
						report();
				}
			}
			$rowCount++;
		}
	}else{
		print("\n Not able to read the file, not a valid file path: ".$file_path." \n");
		return;
	}
}


?>