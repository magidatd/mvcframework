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

		/**
		 * @param string $url
		 * @return void
		 */
		public function redirect(string $url): void
		{
			header('Location: ' . $url);
		}
	}