<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core\form;

	use app\core\Model;

	/**
	 *
	 */
	class Form
	{
		/**
		 * @param $action
		 * @param $method
		 * @return \app\core\form\Form
		 */
		public static function begin($action, $method): Form
		{
			echo sprintf('<form action="%s" method="%s">', $action, $method);
			return new Form();
		}

		/**
		 * @return void
		 */
		public static function end(): void
		{
			echo '</form>';
		}

		/**
		 * @param \app\core\Model $model
		 * @param                 $attribute
		 * @param                 $label
		 * @return \app\core\form\Field
		 */
		public function field(Model $model, $attribute, $label): Field
		{
			return new Field($model, $attribute, $label);
		}
	}