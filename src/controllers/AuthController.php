<?php
	/*
	 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
	 */

	namespace app\controllers;

	use app\core\Controller;
	use app\core\Request;
	use app\models\RegisterModel;

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
			if ($request->isPost())
			{
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
			$registerModel = new RegisterModel();

			if ($request->isPost())
			{
				$registerModel->loadData($request->getBody());

				if ($registerModel->validate() && $registerModel->register())
				{
					return 'Success';
				}

				$this->setLayout('auth');
				return $this->render('auth/register', [
					'model' => $registerModel
				]);
			}

			$this->setLayout('auth');
			return $this->render('auth/register', [
				'model' => $registerModel
			]);
		}
	}