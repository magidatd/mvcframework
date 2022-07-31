<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	use app\controllers\AuthController;
	use app\controllers\SiteController;
	use app\core\Application;

	require_once __DIR__ . '../../vendor/autoload.php';

	$app = new Application(dirname(__DIR__));

	$app->router->get('/', [SiteController::class, 'home']);

	$app->router->get('/contacts', [SiteController::class, 'contacts']);

	$app->router->post('/contacts', [SiteController::class, 'handleContact']);
	
	$app->router->get('/login', [AuthController::class, 'login']);
	$app->router->post('/login', [AuthController::class, 'login']);
	$app->router->get('/register', [AuthController::class, 'register']);
	$app->router->post('/register', [AuthController::class, 'register']);

	$app->run();