<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	/**
	 *
	 */
	class Database
	{
		/**
		 * @var \PDO
		 */
		public \PDO $pdo;

		/**
		 * @param array $config
		 */
		public function __construct(array $config)
		{
			$dsn = $config['dsn'] ?? '';
			$user = $config['user'] ?? '';
			$password = $config['password'] ?? '';

			$this->pdo = new \PDO($dsn, $user, $password);
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		/**
		 * @param $direction
		 * @return void
		 */
		public function applyMigrations($direction): void
		{
			$this->createMigrationsTable();
			$appliedMigrations = $this->getAppliedMigrations();

			$newMigrations = [];
			$files = scandir(Application::$ROOT_DIR . '/migrations');

			$toApplyMigrations = array_diff($files, $appliedMigrations);
			foreach ($toApplyMigrations as $migration) {
				if ($migration === '.' || $migration === '..') {
					continue;
				}

				require_once Application::$ROOT_DIR . "/migrations/$migration";
				$className = pathinfo($migration, PATHINFO_FILENAME);
				$instance = new $className();

				$this->log("Applying migration $migration");
				if ($direction === 'up') {
					$instance->up();
				}
				else {
					$instance->down();
				}
				$this->log("Applied migration $migration");
				$newMigrations[] = $migration;
			}

			if (!empty($newMigrations)) {
				$this->saveMigrations($newMigrations);
			}
			else {
				$this->log("All migrations are applied");
			}
		}

		/**
		 * @return void
		 */
		public function createMigrationsTable(): void
		{
			$this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
    			id INT AUTO_INCREMENT PRIMARY KEY,
    			migration VARCHAR(255),
    			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			) ENGINE=innodb;");
		}

		/**
		 * @return bool|array
		 */
		public function getAppliedMigrations(): bool|array
		{
			$statement = $this->pdo->prepare("SELECT migration FROM migrations");
			$statement->execute();

			return $statement->fetchAll(\PDO::FETCH_COLUMN);
		}

		/**
		 * @param array $migrations
		 * @return void
		 */
		public function saveMigrations(array $migrations): void
		{
			$str = implode(",", array_map(fn($m) => "('$m')", $migrations));

			$statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
                                       $str
                                       ");
			$statement->execute();
		}

		/**
		 * @param $sql
		 * @return bool|\PDOStatement
		 */
		public function prepare($sql): bool|\PDOStatement
		{
			return $this->pdo->prepare($sql);
		}

		/**
		 * @param $message
		 * @return void
		 */
		protected function log($message): void
		{
			echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
		}
	}