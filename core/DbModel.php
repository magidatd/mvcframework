<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	/**
	 *
	 */
	abstract class DbModel extends Model
	{
		/**
		 * @return string
		 */
		abstract static public function tableName(): string;

		/**
		 * @param $table
		 * @return array
		 */
		abstract public function attributes($table): array;

		/**
		 * @return string
		 */
		abstract public function primaryKey(): string;

		/**
		 * @return bool
		 */
		public function save(): bool
		{
			$tableName = $this->tableName();
			$attributes = $this->attributes($tableName);

			$params = array_map(fn($attr) => ":$attr", $attributes);
			$statement = self::prepare("insert into $tableName (" . implode(', ', $attributes) . ") 
			values (" . implode(",", $params) . ")");

			foreach ($attributes as $attribute) {
				$statement->bindValue(":$attribute", $this->{$attribute});
			}

			$statement->execute();
			return true;
		}

		/**
		 * @param $where
		 * @return \app\core\DbModel|false|mixed|object|\stdClass|null
		 */
		public static function findOne($where): mixed
		{
			$tableName = static::tableName();
			$attributes = array_keys($where);

			$sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
			$statement = self::prepare("select * from $tableName where $sql");

			foreach ($where as $key => $value) {
				$statement->bindValue(":$key", $value);
			}

			$statement->execute();
			return $statement->fetchObject(static::class);
		}

		/**
		 * @param $sql
		 * @return bool|\PDOStatement
		 */
		public static function prepare($sql): bool|\PDOStatement
		{
			return Application::$app->db->pdo->prepare($sql);
		}
	}