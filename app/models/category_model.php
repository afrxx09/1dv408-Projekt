<?php
namespace models;

class CategoryModel extends \core\AppModel{
	
	public $hasMany = array('Product');
	public $allowedFields = array('id', 'name', 'description');
	/*
	public $validate = array(
		'name' => array(
			array('alpha_num', 'Only alphanumerical characters allowed.'),
			array(array('min_length', 2), 'Must be atleast 2 characters.'),
			array(array('max_length', 20), 'Must be less than 20 characters.')
		),
		'description' => array(
			array('alpha_num', 'Only alphanumerical characters allowed.'),
			array(array('min_length', 2), 'Must be atleast 2 characters.'),
			array(array('max_length', 20), 'Must be less than 20 characters.')
		)
	);
	*/
}