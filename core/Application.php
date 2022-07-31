<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	/**
	 *
	 */
	class Application
	{
		/**
		 * @var string
		 */
		public static string $ROOT_DIR;
		/**
		 * @var \app\core\Router
		 */
		public Router $router;
		/**
		 * @var \app\core\Request
		 */
		public Request $request;
		/**
		 * @var \app\core\Response
		 */
		public Response $response;
		/**
		 * @var \app\core\Application
		 */
		public static Application $app;

		/**
		 * @param $rootPath
		 */
		public function __construct($rootPath)
		{
			self::$ROOT_DIR = $rootPath;
			self::$app = $this;
			$this->request = new Request();
			$this->response = new Response();
			$this->router = new Router($this->request, $this->response);
		}

		/**
		 * @return void
		 */
		public function run(): void
		{
			echo $this->router->resolve();
		}
	}