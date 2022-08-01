<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	use app\core\Application;

	/**
	 *
	 */
	class m0002_add_password_column
	{
		/**
		 * @return void
		 */
		public function up(): void
		{
			$db = Application::$app->db;
			$db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");
		}

		/**
		 * @return void
		 */
		public function down(): void
		{
			$db = Application::$app->db;
			$db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");
		}
	}

