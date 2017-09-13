<?php
	require '../src/AsyncPHP.php';

	use AymericDev\AsyncPHP\AsyncPHP;

	if ($_SERVER["REQUEST_METHOD"] == "PUT")
	{
		//-------------START------------
		// this code will be executed asynchronously
		parse_str(file_get_contents("php://input"),${"_".$_SERVER["REQUEST_METHOD"]}); // create $_PUT or $_DELETE and what you set as method
		sleep($_PUT["time"]);
		file_put_contents("test", json_encode($_PUT));
		exit (0);
		//-------------END------------
	}

	$asyncPHP = new AsyncPHP();
	var_dump($asyncPHP->getUrl()); // current URL as default
	$asyncPHP->addParam('time', 2);
	// remove time2 get on exemple.com?time2=test
	$asyncPHP->removeParam('time2');
	$asyncPHP->setMethod("PUT"); // set GET POST PUT and what you want
	$asyncPHP->run(); // send new request to URL