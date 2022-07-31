<?php
	/*
	 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
	 */

	namespace app\controllers;

	use app\core\Application;
	use app\core\Controller;
	use app\core\Request;

	/**
	 *
	 */
	class SiteController extends Controller
	{
		/**
		 * @return bool|array|string
		 */
		public function home(): bool|array|string
		{
			$params = [
				'name' => 'Magida Software',
			];
			return $this->render('home', $params);
		}

		/**
		 * @return bool|array|string
		 */
		public function contacts(): bool|array|string
		{
			return $this->render('contacts');
		}

		/**
		 * @param \app\core\Request $request
		 * @return string
		 */
		public function handleContact(Request $request): string
		{
			$body = $request->getBody();

			return 'Handling submitted data';
		}
	}