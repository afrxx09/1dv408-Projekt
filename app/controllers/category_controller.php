<?php
namespace controllers;

class CategoryController extends \core\AppController{
	private $view;
	
	public function __construct(){
		$this->view = new \views\CategoryView();
	}
	
	public function index(){
		//return $this->view->index($this->model->getCategories());
		$viewVars = array('indexMessage' => 'Dynamiskt hej från category#index');
		return $this->view->evaluate(ROOT_DIR . 'app\views\category\index.php', $viewVars);
	}

	public function view(){
		echo $this->params[0];
	}

	public function edit(){
		echo $this->params[0];
	}
}