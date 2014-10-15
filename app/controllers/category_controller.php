<?php
namespace controllers;

class CategoryController extends \core\AppController{
	
	public function __construct(){
		$this->view = new \views\CategoryView();
	}
	
	public function index(){
		$this->view->setVar('indexMessage', 'Dynamiskt hej från category#index');
	}

	public function view(){
		return $this->view->view($this->params[0]);
	}

	public function edit(){
		//return $this->view->edit($this->params[0]);
	}
}