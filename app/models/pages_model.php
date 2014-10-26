<?php

namespace models;

class PagesModel extends \core\AppModel{
	public $hasMany = array('Category');
}