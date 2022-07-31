<?php
/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

namespace app\models;

	use app\core\Model;
	use JetBrains\PhpStorm\ArrayShape;

	class RegisterModel extends Model
	{
		public string $firstname;
		public string $lastname;
		public string $email;
		public string $password;
		public string $confirmPassword;

		public function register()
		{
			echo 'Creating new user';
		}

		#[ArrayShape(['firstname' => "array", 'lastname' => "array", 'email' => "array", 'password' => "array"])] function rules(): array
		{
			return [
				'firstname' => [self::RULE_REQUIRED],
				'lastname' => [self::RULE_REQUIRED],
				'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
				'password' => [self::RULE_REQUIRED, [self::RULE_MINIMUM, 'min' => 8], [self::RULE_MAXIMUM, 'max' =>
					24]],
				'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
			];
		}
	}