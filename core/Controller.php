<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	/**
	 *
	 */
	class Controller
	{
		/**
		 * @var string
		 */
		public string $layout = 'main';

		/**
		 * @param       $view
		 * @param array $params
		 * @return bool|array|string
		 */
		public function render($view, array $params = []): bool|array|string
		{
			return Application::$app->router->renderView($view, $params);
		}

		/**
		 * @param $layout
		 * @return void
		 */
		public function setLayout($layout): void
		{
			$this->layout = $layout;
		}
	}