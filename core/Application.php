<?php

/* Class Application
 *
 */

namespace app\core;

Class Application
{
	public static string $ROOT_DIR;
	public static string $THE_TEMPLATE;
	public Router $router;
	public Request $request;
	public Response $response;
	public Controller $controller;
	public static Application $app;

	Public function __construct($rootPath) 
	{
		self::$ROOT_DIR = $rootPath;
		self::$THE_TEMPLATE = 'main';
		self::$app = $this; 
		$this->request = new Request();
		$this->response = new Response();
		$this->router = new Router($this->request,$this->response);
	}

	public function run()
	{
		echo $this->router->resolve();
	}

	public function getController() : \app\core\Controller
	{
		return $this->Controller;
	}	

	public function setController(\app\core\Controller $controller): void
	{
		$this->Controller = $controller;
	}	
}
