<?php
namespace controllers;

class ProductController extends \core\AppController{
	public function view(){
		$product = $this->Product->first($this->params[0]);
		$this->view->setVar('product', $product);
	}
}