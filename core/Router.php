<?php

/* Class Router
 *
 */

namespace app\core;
use app\controllers\SiteController;

Class Router
{
	public Request $request;
	public Response $response;
	protected array $routes = [];

	public function __construct(Request $request, Response $response)
	{
		$this->request = $request;
		$this->response = $response;
	}

	Public function get($path, $callback)
	{
		$this->routes['get'][$path] = $callback;
	}

	Public function post($path, $callback)
	{
		$this->routes['post'][$path] = $callback;
	}

	Public function resolve() 
	{
		$path = $this->request->getPath();
		$method = $this->request->method();
		$callback = $this->routes[$method][$path] ?? false;

		if ($callback === false)  {
			$this->response->setStatusCode(404);
			return $this->renderView(404);
		}
		if (is_string($callback)) {
			return $this->renderView($callback);
		}
		if (is_array($callback)) {
			Application::$app->controller = new $callback[0]();
			$callback[0] = Application::$app->controller;
		}
		return call_user_func($callback, $this->request);
	}

	Public function renderView($view, $params = []) 
	{
		$layoutContent = $this->layoutContent();
		if ($params['model']) {
			$params = $params['model'];
		}
		$viewContent = $this->renderOnlyView($view, $params);
		return str_replace('{{content}}', $viewContent, $layoutContent);
	}

	protected function layoutContent()
	{
		$layout = Application::$app->controller->layout;
		ob_start();
		include_once Application::$ROOT_DIR."/views/layouts/$layout/main.php";
		$output = ob_get_clean();
		return $output;
		unset($output);
	}
	protected function renderOnlyview($view, $params)
	{
		$layout = Application::$app->controller->layout;
		$output = file_get_contents(Application::$ROOT_DIR."/views/layouts/$layout/$view.php");
		foreach ($params as $key => $value) {
			$output = str_replace("{{{$key}}}", $value, $output);
		}
		return $output;
		unset($output);
	}
}
