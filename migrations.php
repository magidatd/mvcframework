<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	use app\core\Application;

	require_once __DIR__ . '../vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->safeLoad();

	$config = [
		'db' => [
			'dsn' => $_ENV['DB_DSN'],
			'user' => $_ENV['DB_USER'],
			'password' => $_ENV['DB_PASSWORD'],
		],
	];

	$app = new Application(dirname(__DIR__), $config);


	$app->db->applyMigrations();

