<?php 
	namespace Core;

	/**
	 * Controlleur principal
	 */
	class Controller
	{
		public $page;
		public $model;
		public $action;
		public $request;
		public $user;
		protected $app;
		protected $objetRetour = [
			'success' => false, 
			'data' => null, 
			'message' => null
		];

		/**
		 * Le cosntructeur du controlleur charge les données correspondantes aux attributs
		 * @param $model = Le nom du modèle
		 * @param $action = L'action à exécuter
		 * @param $vars = les différentes variables reçues dans l'url
		 * @return void
		 */
		public function __construct($model, $action, $vars, Application $app)
		{
			$this->app = $app;
			$this->model = $this->loadModel($model);
			$this->action = $action;
			$this->vars = $vars;
			$this->user = new User;
			$method = $this->action;

			if (is_callable([$this, $method])) {
				$this->$method(new Request, new Response($this->app));
			}
			
		}

		/**
		 * Permet de charger le model correspondant au controller
		 * @param $model = Le nom du modèle en question
		 * @return $mod Object = L'instance du modèle
		 */
		public function loadModel($model)
		{
			$mod = 'Apps\\'.$this->app->nameApp().'\\Models\\'.ucfirst($model).'Model';

			// if (!class_exists($mod)) {
			// 	throw new \RuntimeException('Le model '.$mod.' n\'existe pas.');
			// }

			if (class_exists($mod)) {
				return new $mod;
			}

			return false;
		}
	}

 ?>