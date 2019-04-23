<?php
	namespace Core;

	/**
	 * Le Router : permet de gérer la routage des routes et des urls
	 */
	class Router
	{
		protected $routes = [];

		const NO_ROUTE = 1;
		
		public function addRoute(Route $route)
		{
			if (!in_array($route, $this->routes)) {
				$this->routes[] = $route;
			}
		}

		public function getRoute($url)
		{
			$urls = [];

			foreach ($this->routes as $route) {
				// Si la route correspond à l'URL
				if (($varsValues = $route->match($url)) !== false) {
					// Si elle a des variables

					if ($route->hasVars()) {
						$varsNames = $route->varsNames();
						$listVars = [];

						foreach ($varsValues as $key => $match) {
							if ($key !== 0) {
								$listVars[$varsNames[$key - 1]] = $match;
							}else{
								$listVars['url'] = substr($match, 1);
							}

						}
						// debug($listVars);

						$route->setVars($listVars);
					}
					else{
						
						if (count($varsValues) > 1) {
							$route->setVars(['id' => $varsValues[1]]);
						}
						
					}

					return $route;
				}
			}
		}
	}

 ?>