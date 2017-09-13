# AsyncPHP

Make asynchronous request in PHP

## Install

### Composer
```bash
	composer require aymericdev/asyncphp
```

### Manualy
```php
	require ('AsyncPHP/src/AsyncPHP.php');
```

## How to use it
```php
	$asyncPHP = new AymericDev\AsyncPHP\AsyncPHP();
	var_dump($asyncPHP->getUrl()); // current URL as default
	$asyncPHP->addParam('time', 2);
	$asyncPHP->setMethod("PUT"); // set GET POST PUT and what you want
	$asyncPHP->run(); // send new request to URL
```

```php
	if ($_SERVER["REQUEST_METHOD"] == "PUT") // set in $asyncPHP->setMethod("PUT");
	{
		//-------------START------------
		// this code will be executed asynchronously
		parse_str(file_get_contents("php://input"),${"_".$_SERVER["REQUEST_METHOD"]}); // create $_PUT or $_DELETE and what you set as var
		sleep($_PUT["time"]); // user param added in $asyncPHP->addParam('time', 2);
		file_put_contents("test", json_encode($_PUT));
		exit (0);
		//-------------END------------
	}
```