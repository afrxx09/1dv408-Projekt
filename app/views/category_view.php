<?php
namespace views;

class CategoryView extends \core\AppView{

	protected $javascript = array('category.js');
	protected $css = array('category.css');

	public function view($id){
		return '
			<p>
				class: Category, view: view, index: ' . $id . '
			</p>
			<p>
				<a href="' . \Routes::getRoute('category') . '">Return</a>
			</p>
		';
	}
}