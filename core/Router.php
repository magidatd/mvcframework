<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	/**
	 *
	 */
	class Router
	{
		/**
		 * @var \app\core\Request
		 */
		public Request $request;
		/**
		 * @var \app\core\Response
		 */
		public Response $response;
		/**
		 * @var array
		 */
		protected array $routes = [];

		/**
		 * @param \app\core\Request  $request
		 * @param \app\core\Response $response
		 */
		public function __construct(Request $request, Response $response)
		{
			$this->request = $request;
		}

		/**
		 * @param $path
		 * @param $callback
		 * @return void
		 */
		public function get($path, $callback): void
		{
			$this->routes['get'][$path] = $callback;
		}

		/**
		 * @return mixed
		 */
		public function resolve(): mixed
		{
			$path = $this->request->getPath();
			$method = $this->request->getMethod();

			$callback = $this->routes[$method][$path] ?? false;

			if ($callback === false)
			{
				Application::$app->response->setStatusCode(404);
				return 'Not found';
			}

			if (is_string($callback))
			{
				return $this->renderView($callback);
			}

			return call_user_func($callback);
		}

		/**
		 * @param $view
		 * @return array|bool|string|string[]
		 */
		public function renderView($view)
		{
			$layoutContent = $this->layoutContent();
			$viewContent = $this->renderOnlyView($view);
			return str_replace('{{content}}', $viewContent, $layoutContent);
		}

		/**
		 * @return bool|string
		 */
		protected function layoutContent(): bool|string
		{
			ob_start();
			include_once Application::$ROOT_DIR . "/src/views/layouts/main.php";
			return ob_get_clean();
		}

		/**
		 * @param $view
		 * @return bool|string
		 */
		protected function renderOnlyView($view): bool|string
		{
			ob_start();
			include_once Application::$ROOT_DIR . "/src/views/$view.php";
			return ob_get_clean();
		}
	}