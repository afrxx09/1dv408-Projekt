<?php
namespace models;

class ProductModel extends \core\AppModel{
	public $belongsTo = array('Category');	
}