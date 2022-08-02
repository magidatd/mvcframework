<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	/**
	 *
	 */
	class Session
	{
		/**
		 *
		 */
		protected const FLASH_KEY = 'flash_messages';

		/**
		 *
		 */
		public function __construct()
		{
			session_start();
			$flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
			foreach ($flashMessages as $key => &$flashMessage) {
				$flashMessage['remove'] = true;
			}

			$_SESSION[self::FLASH_KEY] = $flashMessages;
		}

		/**
		 * @param $key
		 * @param $message
		 * @return void
		 */
		public function setFlash($key, $message): void
		{
			$_SESSION[self::FLASH_KEY][$key] = [
				'remove' => false,
				'value' => $message,
			];
		}

		/**
		 * @param $key
		 * @return false|mixed
		 */
		public function getFlash($key): mixed
		{
			return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
		}

		/**
		 * @param $key
		 * @param $value
		 * @return void
		 */
		public function set($key, $value): void
		{
			$_SESSION[$key] = $value;
		}

		/**
		 * @param $key
		 * @return false|mixed
		 */
		public function get($key): mixed
		{
			return $_SESSION[$key] ?? false;
		}

		/**
		 * @param $key
		 * @return void
		 */
		public function remove($key): void
		{
			unset($_SESSION[$key]);
		}

		/**
		 *
		 */
		public function __destruct()
		{
			$flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
			foreach ($flashMessages as $key => &$flashMessage) {
				if ($flashMessage['remove']) {
					unset($flashMessages[$key]);
				}
			}

			$_SESSION[self::FLASH_KEY] = $flashMessages;
		}
	}