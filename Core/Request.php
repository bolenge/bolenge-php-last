<?php
	namespace Core;
	 
	/**
	 * Gère les différentes requêtes http que l'utilisateur aura lancé
	 */
	class Request
	{
		/**
		 * Sert de renvoyer un cookie
		 * @param {string} $key La clé du cookie
		 * @return $cookie
		 */
		public function getCookie($key)
		{
			return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
		}

		/**
		 * Modifie ou crée un cookie
		 * @param {string} $key la clé du cookie en question
		 * @param {string} $value La valeur du cookie
		 * @param {number} $days Le nombre de jour
		 * @param {bool} $secure L'activation de la sécurité ou pas
		 * @return void
		 */
		public function setCookie($key, $value, $days = 365, $secure = true)
		{
			$temps = time() + $days * 24 * 3600;

			if ($secure) {
				setcookie($key, $value, $temps, null, null, false, true);
			}else{
				setcookie($key, $value, $temps);
			}
		}

		/**
		 * Vérifie un cookie existe
		 * @param {strign} $key La clé du cookie en question
		 * @return {bool} $cookie
		 */
		public function cookieExists($key)
		{
			return isset($_COOKIE[$key]);
		}

		/**
		 * Permet de renvoyer une variable GET
		 * @param {string} $key La clé de la variable en question
		 * @return {any} $_GET[$key] La valeur trouvée
		 */
		public function get($key)
		{
			if ($key) {
				return isset($_GET[$key]) ? $_GET[$key] : null;
			}else {
				return !empty($_GET) ? $_GET : null;
			}
		}

		/**
		 * Permet de renvoyer une variable GET
		 * @param {string} $key La clé de la variable en question
		 * @return {any} $_GET[$key] La valeur trouvée
		 */
		public function params($key = null)
		{
			if ($key) {
				return isset($_GET[$key]) ? $_GET[$key] : null;
			}else {
				return !empty($_GET) ? $_GET : null;
			}
			
		}

		/**
		 * Véfirie si une variable GET existe
		 * @param {string} $key La clé de la variable
		 * @return {bool}
		 */
		public function getExists($key)
		{
			return isset($_GET[$key]);
		}

		/**
		 * Renvoi la variable POST
		 * @param {string} $key La clé du POST en question
		 * @return {any} $post
		 */
		public function post($key = null)
		{
			if ($key) {
				return isset($_POST[$key]) ? $_POST[$key] : null;
			}else {
				return !empty($_POST) ? $_POST : null;
			}
			
		}

		/**
		 * Renvoi la variable POST
		 * @param {string} $key La clé du POST en question
		 * @return {any} $post
		 */
		public function body($key = null)
		{
			if ($key) {
				return isset($_POST[$key]) ? $_POST[$key] : null;
			}else {
				return !empty($_POST) ? $_POST : null;
			}
			
		}

		/**
		 * Renvoi la variable FILES
		 * @param {string} $key La clé du FILES en question
		 * @return {any} $post
		 */
		public function files($key = null)
		{
			if ($key) {
				return isset($_FILES[$key]) ? $_FILES[$key] : null;
			}else {
				return !empty($_FILES) ? $_FILES : null;
			}
			
		}

		/**
		 * Vérifie la variable POST existe
		 * @param {string} $key La clé de la variable en question
		 * @return {bool}
		 */
		public function postExists($key)
		{
			return isset($_POST[$key]);
		}

		/**
		 * Permet de renvoyer la méthode de la requête envoyée
		 * @return {string} $method
		 */
		public function method()
		{
			return $_SERVER['REQUEST_METHOD'];
		}

		/**
		 * Renvoi le uri
		 * @return {string} $uri
		 */
		public static function uri()
		{
			// A decommenté quand on utilise pas POSTMAN
			// return isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
			return isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		}

		/**
		 * Vérifie si les champs d'un formulaire ne sont pas vides
		 * @param {array} $fields Le tableau des champs du formulaire
		 * @return {bool}
		 */
		public function postNotEmpty($fields = [])
		{
			if (count($fields) != 0) {
                foreach ($fields as $field) {
                    if (empty($_POST[$field]) || trim($_POST[$field]) == "") {
                        return false;
                    }
                }
                
                return true;
            }
		}

		/**
		 * Vérifie si les champs d'un formulaire ne sont pas vides
		 * @param {array} $fields Le tableau des champs du formulaire
		 * @return {bool}
		 */
		public function bodyNotEmpty($fields = [])
		{
			if (count($fields) != 0) {
                foreach ($fields as $field) {
                    if (empty($_POST[$field]) || trim($_POST[$field]) == "") {
                        return false;
                    }
                }
                
                return true;
            }
		}


		/**
		 * Vérifie si les champs des données de la méthode GET ne sont pas vides
		 * @param {array} $fields Le tableau des champs
		 * @return {bool}
		 */
		public function getNotEmpty($fields = [])
		{
			if (count($fields) != 0) {
                foreach ($fields as $field) {
                    if (empty($_GET[$field]) || trim($_GET[$field]) == "") {
                        return false;
                    }
                }
                
                return true;
            }
		}

		/**
		 * Vérifie si les champs des données de la méthode GET ne sont pas vides
		 * @param {array} $fields Le tableau des champs
		 * @return {bool}
		 */
		public function paramsNotEmpty($fields = [])
		{
			if (count($fields) != 0) {
                foreach ($fields as $field) {
                    if (empty($_GET[$field]) || trim($_GET[$field]) == "") {
                        return false;
                    }
                }
                
                return true;
            }
		}
	}


 ?>