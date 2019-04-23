<?php
	namespace Core;
	
	session_start();

	/**
	 * User
	 */
	class User
	{
		public function getAttribute($attr)
		{
			return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
		}

		public function isAuthentificated()
		{
			return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
		}

		public function isAdmin()
		{
			return isset($_SESSION['admin']) ? $_SESSION['admin'] : false;
		}

		public function setAttribute($attr, $value)
		{
			$_SESSION[$attr] = $value;
		}

		public function setAuthentificated($authenticated = true)
		{
			if (!is_bool($authenticated)) {
				throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthentificated() doit être un boolean');
			}

			$_SESSION['auth'] = $authenticated;
		}

	}

 ?>