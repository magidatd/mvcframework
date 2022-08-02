<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	abstract class DbModel extends Model
	{
		abstract static public function tableName(): string;

		abstract public function attributes($table): array;

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

		public static function findOne($where)
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

		public static function prepare($sql): bool|\PDOStatement
		{
			return Application::$app->db->pdo->prepare($sql);
		}
	}