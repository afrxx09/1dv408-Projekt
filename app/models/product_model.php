<?php
namespace models;

class ProductModel extends \core\AppModel{
	public $belongsTo = array('Category');
	public $allowedFields = array('id', 'category_id', 'name', 'description');
}