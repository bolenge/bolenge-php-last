<?php 
	namespace Core;

	/**
	 * Application
	 */
	class Application
	{
		public $url;
		public $page;
		protected $name;
		protected $res;

		/**
		 * Charge la page et le controller correspondant à la requête faite par le client
		 * @return void
		 */
		public function __construct()
		{
			$this->page = new Page($this);
			$this->name = '';
			$this->res = new Response($this);
		}

		/**
		 * Renvoi le controller correspondant à la requête faite par le client
		 * @return $controller Object = L'instance du controller
		 */
		public function getController(Application $app)
		{
			$router = new Router;

			$xml = new \DOMDocument;
			// die('../Applications/'.$this->name.'/Config/routes.xml');
			$xml->load('../Applications/'.$this->name.'/Config/routes.xml');
			$routes = $xml->getElementsByTagName('route');

			// On parcours les routes du fichier XML
			foreach ($routes as $route) {
				$vars = [];

				// On regarde si des variables sont présentes dans URL
				if ($route->hasAttribute('vars')) {
					$vars = explode(',', $route->getAttribute('vars'));
				}

				// On ajoute la route au routeur
				$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('controller'), $route->getAttribute('action'), $vars));
			}

			

			if (!$matchedRoute = $router->getRoute(Request::uri())) {
				// debug(Request::uri());
				$this->res->error404();
			}

			// debug($matchedRoute);

			if ($matchedRoute->vars()) {
				if (count($matchedRoute->vars()) > 0) {
					$_GET = array_merge($_GET, $matchedRoute->vars());
				}
			}
				

			$controllerClass = 'Apps\\'.$this->name.'\\Controllers\\'.ucfirst($matchedRoute->controller()).'Controller';

			if (class_exists($controllerClass)) {
				
				return new $controllerClass($matchedRoute->controller(), $matchedRoute->action(), $matchedRoute->vars(), $app);
			}else{
				// debug($controllerClass);
				$this->res->error404();
			}
		}

		/**
		 *Renvoi le nom de l'application en cours de l'utilisation
		 * @return {string} $name Le nom de l'application en question
		 */
		public function nameApp()
		{
			return $this->name;
		}
	}

 ?>