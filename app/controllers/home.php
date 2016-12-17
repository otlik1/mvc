<?php
//require_once '../core/Controller.php';
class Home extends Controller  
{

	public function index($name = '') 
	{
		
		$user = $this->model('User');
		$user->name = $name;

		$this->view('home', ['name' => $user->name] );
	}
}