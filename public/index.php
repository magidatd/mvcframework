<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */
	use app\core\Application;

	require_once __DIR__ . '../../vendor/autoload.php';

	$app = new Application();

	$app->router->get('/', function () {
		return 'Hello World';
	});

	$app->router->get('/contacts', 'contact');

	$app->run();