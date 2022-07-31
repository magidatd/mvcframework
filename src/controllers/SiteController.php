<?php
	/*
	 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
	 */

	namespace app\controllers;

	use app\core\Application;
	use app\core\Controller;
	use app\core\Request;

	class SiteController extends Controller
	{
		public function home(): bool|array|string
		{
			$params = [
				'name' => 'Magida Software',
			];
			return $this->render('home', $params);
		}

		public function contacts(): bool|array|string
		{
			return $this->render('contacts');
		}

		public function handleContact(Request $request): string
		{
			$body = $request->getBody();
			echo '<pre>';
			var_dump($body);
			echo '</pre>';
			exit;
			return 'Handling submitted data';
		}
	}