<?php

function connect()
{
	try 
	{
		$db = new PDO('mysql:host=localhost;dbname=FightGame', 'root', '58375837Zz', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (exception $e)
	{
	    die('erreur : ' . $e->getMessage());
	}

	return $db;	
}