<?php

/* SiteContoller 
 *
 */

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;

Class SiteController extends Controller
{
	public function home()
	{
		$params = [
			'name' => "pants"
		];
		return $this->render('home', $params);
	}

	public function handleContact(Request $request)
	{
		$body = $request->getBody();
		var_dump($body);
		exit;
		return "handling Contact";
	}

	public function contact()
	{
		return $this->render('contact');
	}
	
}
