<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	use app\core\Application;

	/**
	 *
	 */
	class m0001_initial
	{
		/**
		 * @return void
		 */
		public function up(): void
		{
			$db = Application::$app->db;

			$SQL = "CREATE TABLE users (
    			id INT AUTO_INCREMENT PRIMARY KEY,
    			email VARCHAR(255) NOT NULL,
    			firstname VARCHAR(255) NOT NULL,
    			lastname VARCHAR(255) NOT NULL,
    			status TINYINT DEFAULT(0) NOT NULL,
    			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP    			
			) ENGINE=innodb;";
			$db->pdo->exec($SQL);
		}

		/**
		 * @return void
		 */
		public function down(): void
		{
			$db = Application::$app->db;

			$SQL = "DROP TABLE users;";
			$db->pdo->exec($SQL);
		}
	}

