<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */
	use app\core\Application;

	require_once __DIR__ . '../../vendor/autoload.php';

	$app = new Application(dirname(__DIR__));

	$app->router->get('/', 'home');

	$app->router->get('/contacts', 'contacts');

	$app->run();