<?php

namespace controllers;

class PagesController extends \core\AppController{
	protected $helpers = array('Session');
	public function start(){
		$this->view->setVar('flash', $this->Session->renderFlash());
		//empty use view file for render	
	}

	public function contact(){
		//empty use view file for render
	}

	public function categories(){
		$categories = $this->Pages->Category->all();
		$this->view->setVar('categories', $categories);
	}

	public function login(){
		$this->Session->set('admin', true);
		$this->Session->setFlash('Singed in', 'success');
		$this->redirectTo('pages', 'start');
	}

	public function logout(){
		$this->Session->delete('admin', true);
		$this->Session->setFlash('Singed out', 'success');
		$this->redirectTo('pages', 'start');
	}
}