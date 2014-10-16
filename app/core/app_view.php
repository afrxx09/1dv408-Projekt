<?php

namespace core;

class AppView extends \View{
	protected $app_javascript = array('jquery-1.11.1.min.js', 'app_script.js');
	protected $app_css = array('app_style.css');
}