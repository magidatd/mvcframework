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
		public Session $session;
		/**
		 * @var \app\core\Database
		 */
		public Database $db;
		/**
		 * @var \app\core\Application
		 */
		public static Application $app;

		/**
		 * @var \app\core\Controller
		 */
		public Controller $controller;

		/**
		 * @return \app\core\Controller
		 */
		public function getController(): Controller
		{
			return $this->controller;
		}

		/**
		 * @param \app\core\Controller $controller
		 */
		public function setController(Controller $controller): void
		{
			$this->controller = $controller;
		}

		/**
		 * @param       $rootPath
		 * @param array $config
		 */
		public function __construct($rootPath, array $config)
		{
			self::$ROOT_DIR = $rootPath;
			self::$app = $this;
			$this->request = new Request();
			$this->response = new Response();
			$this->session = new Session();
			$this->router = new Router($this->request, $this->response);

			$this->db = new Database($config['db']);
		}

		/**
		 * @return void
		 */
		public function run(): void
		{
			echo $this->router->resolve();
		}
	}