<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\models;

	use app\core\Application;
	use app\core\Model;
	use JetBrains\PhpStorm\ArrayShape;

	/**
	 *
	 */
	class LoginForm extends Model
	{
		/**
		 * @var string
		 */
		public string $email = '';
		/**
		 * @var string
		 */
		public string $password = '';

		/**
		 * @return array[]
		 */
		#[ArrayShape(['email' => "array", 'password' => "array"])] public function rules(): array
		{
			return [
				'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
				'password' => [self::RULE_REQUIRED],
			];
		}

		/**
		 * @return string[]
		 */
		#[ArrayShape(['email' => "string", 'password' => "string"])] public function labels(): array
		{
			return [
				'email' => 'Email Address',
				'password' => 'Password',
			];
		}

		/**
		 * @return string[]
		 */
		#[ArrayShape(['email' => "string", 'password' => "string"])] public function placeholders(): array
		{
			return [
				'email' => 'Enter your email address',
				'password' => 'Enter your password',
			];
		}

		/**
		 * @return false|void
		 */
		public function login()
		{
			$user = User::findOne(['email' => $this->email]);
			if (!$user) {
				$this->addError('email', 'User does not exist with this email address');
				return false;
			}
			if (!password_verify($this->password, $user->password)) {
				$this->addError('password', 'Password is incorrect');
				return false;
			}

			return Application::$app->login($user);
		}
	}