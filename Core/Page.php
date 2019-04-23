<?php
	namespace Core;

	/**
	 * Page : Permet de gérer les contenus et les tampletes qui seront affichés à l'utilisateur
	 */
	class Page
	{
		protected $contentFile;
		protected $vars = [];
		protected $template = '';
		protected $app;

		public function __construct(Application $app)
		{
			$this->app = $app;
			$this->template = '../Applications/'.$this->app->nameApp().'/Views/layout.php';
		}

	}

 ?>