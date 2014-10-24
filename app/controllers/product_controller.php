<?php
namespace controllers;

class ProductController extends \core\AppController{
	
	public function index(){
		$products = $this->Product->all();
		$this->view->setVar('products', $products);
	}
	
	public function view(){
		$product = $this->Product->one($this->params[0]);
		$this->view->setVar('product', $product);
	}
	
	public function add(){
		//empty use view-file
	}
	
	public function create(){
		$newProduct = $this->view->getPost();
		$this->Product->check($newProduct);
		if($this->Product->create($newProduct)){
			$this->redirectTo('category', 'view', $newProduct->category_id);
		}
		$this->redirectTo('product', 'add');
	}
	
	public function edit(){
		$product = $this->Product->one($this->params[0]);
		if($product === null){
			$this->redirectTo('product');
		}
		$this->view->setVar('product', $product);
	}
	
	public function save(){
		$product = $this->view->getPost();
		$this->Product->check($product);
		if($this->Product->save($product)){
			$this->redirectTo('product' ,'view', $product->id);
		}
		$this->redirectTo('product', 'edit', $product->id);
	}
	
	public function delete(){
		$product = $this->Product->one($this->params[0]);
		if($product !== null && $this->Product->delete($product)){
			$this->redirectTo('product');
		}
		return 'Could not delete product.';
	}
}