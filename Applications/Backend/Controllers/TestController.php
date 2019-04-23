<?php
	namespace Apps\Backend\Controllers;

	/**
	 * TestController
	 */
	class TestController extends \Core\Controller
	{
		public function index($req, $res)
		{
			$res->render('test/index');
		}
	}