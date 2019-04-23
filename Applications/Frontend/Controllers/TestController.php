<?php
	namespace Apps\Frontend\Controllers;
	use \Core\Controller;

	/**
	 * TestController
	 */
	class TestController extends Controller
	{
		public function index($req, $res)
		{
			echo "Salut les amis";
		}
	}