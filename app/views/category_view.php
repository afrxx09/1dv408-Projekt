<?php
namespace views;

class CategoryView extends \core\AppView{

	public function view($id){
		return '<p>class: Category, view: view, index: ' . $id . '</p>';
	}
}