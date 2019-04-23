<?php
	namespace Apps\Backend; 
	/**
	 * FrondensApplication : L'application du frondend
	 */
	class BackendApplication extends \Core\Application
	{
		
		public function __construct()
		{
			parent::__construct();

			$this->name = 'Backend';
			$this->getController($this);
		}

	}


 ?>