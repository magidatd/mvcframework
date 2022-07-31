<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	class Router
	{
		public Request $request;
		protected array $routes = [];

		/**
		 * @param \app\core\Request $request
		 */
		public function __construct(Request $request)
		{
			$this->request = $request;
		}

		public function get($path, $callback): void
		{
			$this->routes['get'][$path] = $callback;
		}

		public function resolve(): void
		{
			$path = $this->request->getPath();
			$method = $this->request->getMethod();

			$callback = $this->routes[$method][$path] ?? false;

			if ($callback === false)
			{
				echo 'Not found';
				exit;
			}

			echo call_user_func($callback);
		}
	}