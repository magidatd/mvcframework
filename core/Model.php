<?php
/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

namespace app\core;

	use JetBrains\PhpStorm\ArrayShape;

	abstract class Model
	{
		public const RULE_REQUIRED = 'required';
		public const RULE_EMAIL = 'email';
		public const RULE_MINIMUM = 'min';
		public const RULE_MAXIMUM = 'max';
		public const RULE_UNIQUE = 'unique';
		public const RULE_MATCH = 'match';

		public array $errors = [];

		public function loadData($data): void
		{
			foreach ($data as $key => $value)
			{
				if (property_exists($this, $key))
				{
					$this->{$key} = $value;
				}
			}
		}

		abstract function rules(): array;

		public function validate()
		{
			foreach ($this->rules() as $attribute => $rules)
			{
				$value = $this->{$attribute};
				foreach ($rules as $rule)
				{
					$ruleName = $rule;
					if (!is_string($ruleName))
					{
						$ruleName = $rule[0];
					}

					if ($ruleName === self::RULE_REQUIRED && !$value)
					{
						$this->addError($attribute, self::RULE_REQUIRED);
					}

					if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL))
					{
						$this->addError($attribute, self::RULE_EMAIL);
					}
				}
			}

			return empty($this->errors);
		}

		public function addError(string $attribute, string $rule)
		{
			$message = $this->errorMessages()[$rule] ?? '';
			$this->errors[$attribute][] = $message;
		}

		#[ArrayShape([self::RULE_REQUIRED => "string", self::RULE_EMAIL => "string", self::RULE_MINIMUM => "string", self::RULE_MAXIMUM => "string", self::RULE_UNIQUE => "string", self::RULE_MATCH => "string"])] public function errorMessages(): array
		{
			return [
				self::RULE_REQUIRED => 'This field is required',
				self::RULE_EMAIL => 'This field must be a valid email address',
				self::RULE_MINIMUM => 'Minimun length of this field must be {min}',
				self::RULE_MAXIMUM => 'Maximun length of this field must be {max}',
				self::RULE_UNIQUE => 'This field must be unique',
				self::RULE_MATCH => 'This field must match {match}'
			];
		}
	}