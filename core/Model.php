<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	use JetBrains\PhpStorm\ArrayShape;

	/**
	 *
	 */
	abstract class Model
	{
		/**
		 *
		 */
		public const RULE_REQUIRED = 'required';
		/**
		 *
		 */
		public const RULE_EMAIL = 'email';
		/**
		 *
		 */
		public const RULE_MINIMUM = 'min';
		/**
		 *
		 */
		public const RULE_MAXIMUM = 'max';
		/**
		 *
		 */
		public const RULE_UNIQUE = 'unique';
		/**
		 *
		 */
		public const RULE_MATCH = 'match';

		/**
		 * @var array
		 */
		public array $errors = [];

		/**
		 * @param $data
		 * @return void
		 */
		public function loadData($data): void
		{
			foreach ($data as $key => $value) {
				if (property_exists($this, $key)) {
					$this->{$key} = $value;
				}
			}
		}

		/**
		 * @return array
		 */
		abstract function rules(): array;

		/**
		 * @return bool
		 */
		public function validate(): bool
		{
			foreach ($this->rules() as $attribute => $rules) {
				$value = $this->{$attribute};
				foreach ($rules as $rule) {
					$ruleName = $rule;

					if (!is_string($ruleName)) {
						$ruleName = $rule[0];
					}

					if ($ruleName === self::RULE_REQUIRED && !$value) {
						$this->addError($attribute, self::RULE_REQUIRED);
					}

					if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
						$this->addError($attribute, self::RULE_EMAIL);
					}

					if ($ruleName === self::RULE_MINIMUM && strlen($value) < $rule['min']) {
						$this->addError($attribute, self::RULE_MINIMUM, $rule);
					}

					if ($ruleName === self::RULE_MAXIMUM && strlen($value) > $rule['max']) {
						$this->addError($attribute, self::RULE_MAXIMUM, $rule);
					}

					if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
						$this->addError($attribute, self::RULE_MATCH, $rule);
					}
				}
			}

			return empty($this->errors);
		}

		/**
		 * @param string $attribute
		 * @param string $rule
		 * @param array  $params
		 * @return void
		 */
		public function addError(string $attribute, string $rule, array $params = []): void
		{
			$message = $this->errorMessages()[$rule] ?? '';
			foreach ($params as $key => $value) {
				$message = str_replace("{{$key}}", $value, $message);
			}
			$this->errors[$attribute][] = $message;
		}

		/**
		 * @return string[]
		 */
		#[ArrayShape([self::RULE_REQUIRED => "string", self::RULE_EMAIL => "string", self::RULE_MINIMUM => "string", self::RULE_MAXIMUM => "string", self::RULE_UNIQUE => "string", self::RULE_MATCH => "string"])] public function errorMessages(): array
		{
			return [
				self::RULE_REQUIRED => 'This field is required',
				self::RULE_EMAIL => 'This field must be a valid email address',
				self::RULE_MINIMUM => 'Minimum length of this field must be {min}',
				self::RULE_MAXIMUM => 'Maximum length of this field must be {max}',
				self::RULE_UNIQUE => 'This field must be unique',
				self::RULE_MATCH => 'This field must match {match}',
			];
		}

		/**
		 * @param $attribute
		 * @return false|mixed
		 */
		public function hasError($attribute): mixed
		{
			return $this->errors[$attribute] ?? false;
		}

		/**
		 * @param $attribute
		 * @return mixed|string
		 */
		public function getFirstError($attribute): mixed
		{
			$errors = $this->errors[$attribute] ?? [];
			return $errors[0] ?? '';
		}
	}