<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	use app\controllers\SiteController;
	use app\core\Application;

	require_once __DIR__ . '../../vendor/autoload.php';

	$app = new Application(dirname(__DIR__));

	$app->router->get('/', [SiteController::class, 'home']);

	$app->router->get('/contacts', [SiteController::class, 'contacts']);

	$app->router->post('/contacts', [SiteController::class, 'handleContact']);

	$app->run();