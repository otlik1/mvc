<?php


class App
{
	protected $controller = 'home';
	protected $method = 'index';
	protected $params = [];

	public function __construct()
	{
		$url = $this->parseUrl(); // wywoluje metode do parsowania url

		if(file_exists('../app/controllers/' . $url[0] . '.php'))
		{
			$this->controller = $url[0];
			unset($url[0]);
		} //sprawdzam czy kontroller istnieje

		require_once '../app/controllers/' . $this->controller . '.php'; //jezeli nie to laduje domyslny controller home

		$this->controller = new $this->controller; //do parametru tworze nowy obiekt kontroller

		if (isset($url[1])) 
		{
			if(method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}	//sprawdzam czy w pliku isteje metoda
		}

		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);


	}

	public function parseUrl()
	{
		if (isset($_GET['url'])) {
			
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)); 	
		}
	}
}