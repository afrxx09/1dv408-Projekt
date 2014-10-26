<?php

namespace core;

class AppView extends \View{
	protected $appJavascript = array('jquery-1.11.1.min.js', 'app_script.js');
	protected $appCss = array('app_style.css');
}