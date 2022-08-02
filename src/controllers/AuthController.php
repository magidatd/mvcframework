<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\controllers;

	use app\core\Application;
	use app\core\Controller;
	use app\core\Request;
	use app\core\Response;
	use app\models\LoginForm;
	use app\models\User;

	/**
	 *
	 */
	class AuthController extends Controller
	{
		public function login(Request $request, Response $response,): bool|array|string|null
		{
			$loginForm = new LoginForm();
			if ($request->isPost()) {
				$loginForm->loadData($request->getBody());

				if ($loginForm->validate() && $loginForm->login()) {
					$response->redirect('/');
					exit;
				}
			}
			$this->setLayout('auth');
			return $this->render('auth/login', [
				'model' => $loginForm,
			]);
		}

		/**
		 * @param \app\core\Request $request
		 * @return bool|array|string
		 */
		public function register(Request $request): bool|array|string
		{
			$user = new User();

			if ($request->isPost()) {
				$user->loadData($request->getBody());

				if ($user->validate() && $user->save()) {
					Application::$app->session->setFlash('success', "Thank you for registering");
					Application::$app->response->redirect('/');
					exit;
				}

				$this->setLayout('auth');
				return $this->render('auth/register', [
					'model' => $user,
				]);
			}

			$this->setLayout('auth');
			return $this->render('auth/register', [
				'model' => $user,
			]);
		}
	}