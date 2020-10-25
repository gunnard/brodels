<?php

/* Class Controller
 *
 */

namespace app\core;

Class Controller
{
	public string $layout = 'main';

	public function render($view, $params = [])
	{
		return Application::$app->router->renderView($view, $params);

	}

	public function setLayout($layout) 
	{
		$this->layout = $layout;
	}
}

