<?php
	/*
	 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
	 */

	namespace app\core;

	/**
	 *
	 */
	class Request
	{
		/**
		 * @return mixed
		 */
		public function getPath(): mixed
		{
			$path = $_SERVER['REQUEST_URI'] ?? '/';
			$position = strpos($path, '?');
			if ($position === false)
			{
				return $path;
			}

			return substr($path, 0, $position);
		}

		/**
		 * @return string
		 */
		public function getMethod(): string
		{
			return strtolower($_SERVER['REQUEST_METHOD']);
		}
	}