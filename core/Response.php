<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	/**
	 *
	 */
	class Response
	{
		/**
		 * @param int $code
		 * @return void
		 */
		public function setStatusCode(int $code): void
		{
			http_response_code($code);
		}

		public function redirect(string $url)
		{
			header('Location: ' . $url);
		}
	}