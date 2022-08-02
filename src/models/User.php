<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\models;

	use app\core\Application;
	use app\core\UserModel;
	use JetBrains\PhpStorm\ArrayShape;

	/**
	 *
	 */
	class User extends UserModel
	{
		/**
		 *
		 */
		const STATUS_ACTIVE = 1;
		/**
		 *
		 */
		const STATUS_INACTIVE = 0;
		/**
		 *
		 */
		const STATUS_DELETED = 2;

		/**
		 * @var array|string[]
		 */
		public array $excludeColumns = ["id", "created_at"];
		/**
		 * @var string
		 */
		public string $firstname = '';
		/**
		 * @var string
		 */
		public string $lastname = '';
		/**
		 * @var string
		 */
		public string $email = '';
		/**
		 * @var int
		 */
		public int $status = self::STATUS_INACTIVE;
		/**
		 * @var string
		 */
		public string $password = '';
		/**
		 * @var string
		 */
		public string $confirmPassword = '';

		/**
		 * @return string
		 */
		public static function tableName(): string
		{
			return 'users';
		}

		/**
		 * @return string
		 */
		public static function primaryKey(): string
		{
			return 'id';
		}

		/**
		 * @return bool
		 */
		public function save(): bool
		{
			$this->status = self::STATUS_INACTIVE;
			$this->password = password_hash($this->password, PASSWORD_DEFAULT);
			return parent::save();
		}

		/**
		 * @return array[]
		 */
		#[ArrayShape(['firstname' => "array", 'lastname' => "array", 'email' => "array", 'password' => "array"])] function rules(): array
		{
			return [
				'firstname' => [self::RULE_REQUIRED],
				'lastname' => [self::RULE_REQUIRED],
				'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
				'password' => [self::RULE_REQUIRED, [self::RULE_MINIMUM, 'min' => 8], [self::RULE_MAXIMUM, 'max' =>
					24]],
				'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
			];
		}

		/**
		 * @param $table
		 * @return array
		 */
		public function attributes($table): array
		{
			$columns = [];

			$statement = Application::$app->db->pdo->query("select * from $table limit 0");
			for ($i = 0; $i < $statement->columnCount(); $i++) {
				$col = $statement->getColumnMeta($i);
				$columns[] = $col['name'];
			}
			return array_diff($columns, $this->excludeColumns);
		}

		/**
		 * @return string[]
		 */
		#[ArrayShape(['firstname' => "string", 'lastname' => "string", 'email' => "string", 'password' => "string", 'confirmPassword' => "string"])] public function labels(): array
		{
			return [
				'firstname' => 'First Name',
				'lastname' => 'Last Name',
				'email' => 'Email Address',
				'password' => 'Password',
				'confirmPassword' => 'Password Confirmation',
			];
		}

		/**
		 * @return string[]
		 */
		#[ArrayShape(['firstname' => "string", 'lastname' => "string", 'email' => "string", 'password' => "string", 'confirmPassword' => "string"])] public function placeholders(): array
		{
			return [
				'firstname' => 'Type your first name',
				'lastname' => 'Type your last name',
				'email' => 'Type your email address',
				'password' => 'Type your password',
				'confirmPassword' => 'Retype your password',
			];
		}

		/**
		 * @return string
		 */
		public function getDisplayName(): string
		{
			return $this->firstname . ' ' . $this->lastname;
		}
	}