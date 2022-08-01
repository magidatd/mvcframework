<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\controllers;

	use app\core\Controller;
	use app\core\Request;
	use app\models\User;

	/**
	 *
	 */
	class AuthController extends Controller
	{
		/**
		 * @param \app\core\Request $request
		 * @return bool|array|string
		 */
		public function login(Request $request): bool|array|string
		{
			if ($request->isPost()) {
				return 'Handling submitted data';
			}
			$this->setLayout('auth');
			return $this->render('auth/login');
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
					return 'Success';
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