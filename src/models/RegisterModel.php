<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\models;

	use app\core\Model;
	use JetBrains\PhpStorm\ArrayShape;

	/**
	 *
	 */
	class RegisterModel extends Model
	{
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
		 * @var string
		 */
		public string $password = '';
		/**
		 * @var string
		 */
		public string $confirmPassword = '';

		/**
		 * @return void
		 */
		public function register(): void
		{
			echo 'Creating new user';
		}

		/**
		 * @return array[]
		 */
		#[ArrayShape(['firstname' => "array", 'lastname' => "array", 'email' => "array", 'password' => "array"])] function rules(): array
		{
			return [
				'firstname' => [self::RULE_REQUIRED],
				'lastname' => [self::RULE_REQUIRED],
				'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
				'password' => [self::RULE_REQUIRED, [self::RULE_MINIMUM, 'min' => 8], [self::RULE_MAXIMUM, 'max' =>
					24]],
				'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
			];
		}
	}