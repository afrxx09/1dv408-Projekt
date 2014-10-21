<?php
namespace models;

class CategoryModel extends \core\AppModel{
	
	public function getCategories(){
		return array('Category 1', 'Category två', 'Category three', 'Category quatre', 'Category go');
	}
}