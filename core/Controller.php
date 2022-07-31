<?php
	/*
	 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
	 */

	namespace app\core;

	class Controller
	{
		public function render($view, $params = []): bool|array|string
		{
			return Application::$app->router->renderView($view, $params);
		}
	}