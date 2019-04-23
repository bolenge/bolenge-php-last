<?php 
	namespace Core;

	/**
	 * Gère les réponses http à envoyer au user
	 */
	class Response
	{
		protected $app;
		protected $vars = [];
		protected $contentFile;
		protected $template = '';

		public function __construct(Application $app)
		{
			$this->app = $app;
			$this->template = '../Applications/'.$this->app->nameApp().'/Views/layout.php';
			// $view = $model.'/'.$action;
			// $this->setContentFile($view);
		}

		/**
		 * Permet d'ajoiuter un header dans une reponse à envoyer au user
		 * @param {string} $header Le Header à envoyer
		 * @return void
		 */
		public function addHeader($header)
		{
			header($header);
		}

		/**
		 * Modifie le message flash
		 */
		public function setFlash($value, $type = 'info')
		{
			$_SESSION['flash'] = [];

			if (is_array($value)) {

				$_SESSION['flash']['message'] = '';

				foreach ($value as $v) {
					$_SESSION['flash']['message'] .= $v . '<br />';
				}
			}else{
				$_SESSION['flash']['message'] = $value;
			}
			
			$_SESSION['flash']['type'] = $type;
		}

		/**
		 * Renvoi le message flash
		 * @return {string} $flash le message flash
		 */
		public function getFlash()
		{
			$flash = $_SESSION['flash'];
			unset($_SESSION['flash']);

			return $flash;
		}

		/**
		 * Vérifie un utilisateur a un message flash
		 * @return {bool}
		 */
		public function hasFlash()
		{
			return isset($_SESSION['flash']);
		}

		/**
		 * Permet d'ajouter une variable dans la page
		 * @param {string} $var Le nom de la variable à rajouter
		 * @param {any} $value La valeur que va contenir la variable
		 * @return void
		 */
		public function addVar($var, $value)
		{
			if (!is_string($var) || is_numeric($var) || empty($var)) {
				throw new InvalidArgumentException('Le nom de la variable doit être une chaîne de caratères non nulle');
			}

			$this->vars[$var] = $value;
		}

		/**
		 * Permet de renvoyer la vue
		 * @param {String} $view La vue qu'il faut appeler
		 * @param {Array} $vars Un tableau des variables qu'il faut passer à la vue
		 * @return {void}
		 */
		public function render($view = null, $vars = [])
		{
			$vars += $this->vars;

			if (!empty($vars)) {
				extract($vars);
			}

			if ($view) {
				$this->setContentFile($view);
			}

			if (file_exists($this->contentFile)) {
				$filename = $this->contentFile;
			}else{
				$this->error404();
			}
			
			ob_start();
			require $filename;
			$content = ob_get_clean();

			require $this->template;
		}

		/**
		 * Permet de renvoyer une valeur à la demande du client
		 * @param {*} $data La donnée à renvoyer
		 */
		public function send($data)
		{
			$this->addHeader('Content-Type: application/json');
			
			echo json_encode($data);
			die();
		}

		/**
		 * Modifier le fichier layout (le template de l'application)
		 * @param {string} $tamplate Le nom du template à mettre
		 * @return void
		 */
		public function setTemplate($template)
		{
			$this->template = '../Applications/'.$this->app->nameApp().'/Views/'.$template.'.php';
		}

		public function error($error)
		{
			ob_start();
			require '../Errors/'.$error.'.php';
			$content = ob_get_clean();

			require '../Errors/error.php';
			die();
		}

		/**
		 * Renvoi la page d'erreur 404 (Page Not Found)
		 * @return void
		 */
		public function error404()
		{
			$this->addHeader('HTTP/1.0 404 Not Found');
			$this->error('404');
			die();
		}

		/**
		 * Modifie le fichier qui va contenir le truc à afficher
		 * @param {string} $contentFile Le fichier du contenu
		 * @return void
		 */
		public function setContentFile($contentFile)
		{
			if (!is_string($contentFile) || empty($contentFile)) {
				throw new \InvalidArgumentException('La vue spécifiée est invalide', 1);
			}

			$this->contentFile = '../Applications/'.$this->app->nameApp().'/Views/'.$contentFile.'.php';
		}
	}

 ?>