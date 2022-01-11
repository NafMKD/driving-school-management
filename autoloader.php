<?php

spl_autoload_register('ThisAutoloader');

function ThisAutoloader($classname){
	$path = 'class/'.$classname.'.class.php';
	if(!file_exists($path)){
		return false;
	}
	include_once $path;
	
}