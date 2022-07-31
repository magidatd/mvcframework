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
		public function method(): string
		{
			return strtolower($_SERVER['REQUEST_METHOD']);
		}

		/**
		 * @return bool
		 */
		public function isGet(): bool
		{
			return $this->method() === 'get';
		}

		/**
		 * @return bool
		 */
		public function isPost(): bool
		{
			return $this->method() === 'post';
		}

		/**
		 * @return array
		 */
		public function getBody(): array
		{
			$body = [];

			if ($this->isGet())
			{
				foreach ($_GET as $key => $value)
				{
					$body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
				}
			}

			if ($this->isPost())
			{
				foreach ($_POST as $key => $value)
				{
					$body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
				}
			}

			return $body;
		}
	}