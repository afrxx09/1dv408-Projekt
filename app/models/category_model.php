<?php
namespace models;

class CategoryModel extends \core\AppModel{
	
	public $hasMany = array('Product');
	
}