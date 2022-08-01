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
	const MIGRATION_UP = 'up';
	const MIGRATION_DOWN = 'down';

	$app = new Application(__DIR__, $config);

	$migration = '';
	$option = getopt('', ['migration:']);

	if (!array_key_exists('migration', $option)) {
		echo "No argument supplied on cli use --migration=up or --migration=down" . PHP_EOL;
		exit;
	}
	else if ($option['migration'] === 'up') {
		$migration = MIGRATION_UP;
	}
	else if ($option['migration'] === 'down') {
		$migration = MIGRATION_DOWN;
	}
	else {
		echo "Wrong argument supplied on cli use --migration=up or --migration=down" . PHP_EOL;
		exit;
	}

	$app->db->applyMigrations($migration);

