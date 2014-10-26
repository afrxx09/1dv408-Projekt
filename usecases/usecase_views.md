#Usecase - Views

##Preconditions
* PHP-server setup and framework installed in a accessable folder example: www/myProject/
* Setup routes in routes.php (www/myProject/app/)

	public static $routes = array(
		'root' => 'pages#start',
		'pages' => array('start', 'contact'),
		'category' => 'all'
	);

* Create controller "PagesController" for Pages class and save in www/myProject/app/controllers/ with filename "pages_controller.php"

	namespace controllers;
	class PagesController extends \core\AppController{
		
	}

##Rendering output with strings

###UC1 - Getting simple string output
1. Add public method named "start" to controller class
2. have it simply return a string like "Start action in Pages Controller"
3. Visit root path for project (example: localhost/myProject/)

app/controllers/pages_controller.php

	public function start(){
		return 'Start action in Pages Controller';
	}

####Exprected outcome
	* output: Full HTML dokument with content: 'Start action in Pages Controller'

###UC2 - Rendering with string from view-class
1. Create a new public method in PagesController called "contact" according to example below.
2. Create view class "PagesView" for Pages with nmamespace "views" and save in www/myProject/app/views/ with filename "pages_view.php"
3. Add public method called contact that returns an example string ("String example from view class")
4. Visist the relative path for the contact page (localhost/myProject/pages/contact/)

app/controllers/pages_controller.php

	public function contact(){
		return $this->view->contact();
	}

app/views/pages_view.php

	namespace views;
	class PagesView extends \core\AppView{
		public function contact(){ return 'String example from view class'; }
	}

####Exprected outcome
	* output: Full HTML dokument with content: 'String example from view class'


###UC3 - Render with single purpose view-file

1. Create a new folder in "views"-folder called "pages" (www/myProject/app/views/pages)
2. In this folder create a new file called start.php (www/myProject/app/views/pages/start.php)
3. Add some content to start.php
4. Change the current "start"-method in PagesController to have no content:
5. Visit Root path of project (localhost/myProject/)

app/controllers/pages_controller.php

	public function start(){
		/* empty */
	}

app/views/pages/start.php

	<h1>Start Page</h1>
	<p>This is the start page renderd stright from a view file.</p>

####Expected outcome
	* output: Full HTML dokument with the same content added in app/views/pages/start.php


###UC4 - Manipulate content in view-files with variables

1. Update "start"-method so it sets a variable for the view like the example
2. Update start.php in the app/views/pages-folder so echo out the variable

app/controllers/pages_controller.php

	public function start(){
		$title = 'Start Page';
		$this->view->setVar('title', $title);
	}

app/views/pages/start.php

	<h1><?= $title ?></h1>
	<p>Title set with variable from controller.</p>

####Expected outcome
	* Full HTML document with a h1-tag title with the content "Start Page"