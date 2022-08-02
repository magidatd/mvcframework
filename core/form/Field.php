<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core\form;

	use app\core\Model;

	/**
	 *
	 */
	class Field
	{
		/**
		 *
		 */
		public const TYPE_TEXT = 'text';
		/**
		 *
		 */
		public const TYPE_PASSWORD = 'password';
		/**
		 *
		 */
		public const TYPE_NUMBER = 'number';

		/**
		 * @var string
		 */
		public string $type;
		/**
		 * @var \app\core\Model
		 */
		public Model $model;
		/**
		 * @var string
		 */
		public string $attribute;

		/**
		 * @param \app\core\Model $model
		 * @param string          $attribute
		 */
		public function __construct(Model $model, string $attribute)
		{
			$this->type = self::TYPE_TEXT;
			$this->model = $model;
			$this->attribute = $attribute;
		}

		/**
		 * @return string
		 */
		public function __toString(): string
		{
			return sprintf('
			<div class="mb-3">
				<label for="%s" class="form-label">%s</label>
				<input type="%s" class="form-control%s" id="%s" name="%s" placeholder="%s" value="%s">
				<div class="invalid-feedback">%s</div>
			</div>',
				$this->attribute,
				$this->model->getLabel($this->attribute),
				$this->type,
				$this->model->hasError($this->attribute) ? ' is-invalid' : '',
				$this->attribute,
				$this->attribute,
				$this->model->getPlaceholder($this->attribute),
				$this->model->{$this->attribute},
				$this->model->getFirstError($this->attribute));
		}

		/**
		 * @return $this
		 */
		public function passwordField(): static
		{
			$this->type = self::TYPE_PASSWORD;
			return $this;
		}
	}