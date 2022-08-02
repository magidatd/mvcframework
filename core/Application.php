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
		 * @var string|mixed
		 */
		public string $userClass;
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
		 * @var \app\core\Session
		 */
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
		 * @var \app\core\DbModel|null
		 */
		public ?DbModel $user;

		/**
		 * @return bool
		 */
		public static function isGuest(): bool
		{
			return !self::$app->user;
		}

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
			$this->userClass = $config['userClass'];
			self::$ROOT_DIR = $rootPath;
			self::$app = $this;
			$this->request = new Request();
			$this->response = new Response();
			$this->session = new Session();
			$this->router = new Router($this->request, $this->response);

			$this->db = new Database($config['db']);

			$primaryValue = $this->session->get('user');

			if ($primaryValue) {
				$primaryKey = $this->userClass::primaryKey();
				$this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
			}
			else {
				$this->user = null;
			}
		}

		/**
		 * @return void
		 */
		public function run(): void
		{
			echo $this->router->resolve();
		}

		/**
		 * @param \app\core\DbModel $user
		 * @return bool
		 */
		public function login(DbModel $user): bool
		{
			$this->user = $user;
			$primaryKey = $user->primaryKey();
			$primaryValue = $user->{$primaryKey};
			$this->session->set('user', $primaryValue);

			return true;
		}

		/**
		 * @return void
		 */
		public function logout(): void
		{
			$this->user = null;

			$this->session->remove('user');
		}
	}