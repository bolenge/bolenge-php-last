<?php
	namespace Apps\Frontend; 
	/**
	 * FrondensApplication : L'application du frondend
	 */
	class FrontendApplication extends \Core\Application
	{
		
		public function __construct()
		{
			parent::__construct();

			$this->name = 'Frontend';
			$this->getController($this);
			// $this->page->setTemplate('ApplicationsViews/')
		}

	}


 ?>