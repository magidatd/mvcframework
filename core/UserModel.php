<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	namespace app\core;

	/**
	 *
	 */
	abstract class UserModel extends DbModel
	{
		/**
		 * @return string
		 */
		abstract public function getDisplayName(): string;
	}