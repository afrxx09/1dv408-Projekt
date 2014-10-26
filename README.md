#1dv408 - Webbutveckling med PHP - Linneaus University 2014
[Course homepage](https://coursepress.lnu.se/kurs/webbutveckling-med-php/)
[Assignment instructions(in Swedish)](https://coursepress.lnu.se/kurs/webbutveckling-med-php/laborationsmiljo/projekt/)
Project start: 2014-10-6
Assigned time: 60 hours
Actual start: 2014-10-12
Actual time spent: 70 hours+


##Other documentation
Usecases can be found in this github-repo in the fodler "usecases"
Class diagrams can be found in documentation folder.

##Un-named Framework
The currently un-named framework is a light-weight PHP MVC framwork that is still in its early stages of development. The assigned project time was 60 hours including documentation and planning, wich left one to only focus on the essentials.
The main goal has always been to make the code as dynamic as possible, leaving no room for dead ends as a developer. Dynamic, efficient, spotless are three adjectives that are hard to apply to a project of this kind but I have put in my best efforts to try and match all three.

###Purpose
Why make another framework when there already are hundreds out there?
Well The main purpose was to explore deeper into PHP and MVC, challenging my self to complete a more difficult task.
Also the frameworks that are out there are often big and bloated and not at all suited for smaller applications. My idea is that a smaller code-base, maybe only a few thousand lines of code would be much more efficient than one with tens or even hundreds of thousand lines of code.
Even thogh of course not all code is executed it still has a huge overhead of unused code.
Finally, and i say it again, the purpose was personal. I'm not trying to re-invent the wheel or become a compeditor to cake-php or codeigniter. I want a good solid code base for me, that I can use for various projects. Also something that I can work on and refine for a long time ahead.

###Functionality
Still early in development the framework has some functionality regarding Routing, automatic file includes, MVC base-classes, "master-view" or "layout-view" for dynamic HTML document rendering, partial rendering and much more.

###How it works
####Dispatcher
The framework uses a router/engine/dispatcher, what ever you want to call it, to run the program base on the url request sent.
The dispatcher(as I prefer to call it) take a url request and interprets it to find out what part of the appliaction to run.
If for example the request "mydomain.com/category/view/1" is sent, the dispatcher will interpret the url and load corresponding controller, view and model classes.
The dispatcher will then tell the requested controller to run the desired method and takes care of the result.
The result will be passed on to a "Rendering engine" or "Master view" called "Layout View".
####Layout View
The Layout View will take the result and add it to the layout of the application. It uses templates to render a full HTML-layout where the content is the result that the dispatcher recieved from the controller.
The LayoutView also has the power to add "partials", independent html templates, to the layout as well ass dynamically adding required CSS and javascript files.
CSS and javascript can be added on "application"-level and "controller"-level, in other words, one can create CSS that runs on the entire application as well as smaller more specific ones in just local parts of the application.

####Routing
The framework uses .htaccess to re-write paths into more SEO-friendly ones. This is also how to navigate throug applications.
Instead of accessing php-files and rendering them with paths like:

	"www.mydomain.com/app/views/categories/products/product.php?view-product=123"

The urls will be re-routed into something like this:

	"www.mydomain.com/categoies/product/123"

No get paramters, no visible file paths. More good looking and safer.

Also routes or paths has to be declared to work, trying to access paths not specified by the developer will result in a 404

	"www.mydomain.com/NotA/Valid/Path" => "404 not found"

#####Setting up routes
Routes can be declared in various ways for different purposes. All routes are gatherd in a single file in the app-folder.

######Setting up root paths

	/*Root path goes to default controller and action method found in the config-file */
	public static routes = array(
		'root' => ''
	)

	/*Root path goes to designated controller and uses DEFAULT_ACTION in the config to decide what action to run */
	public static routes = array(
		'root' => 'controller'
	)

	/*Root goes to designated controller and action-method*/
	public static routes = array(
		'root' => 'controller#actionmethod'
	)

######Setting up routes for a controller:

	/* Sets up routes for basic CRUD routes (index, view, add, create, edit, save, delete) */
	public static routes = array(
		'controller' => 'all'
	)


	/* Set up routes for a set of routes */
	public static routes = array(
		'controller' => array('index', add', 'delete')
	)

######Seting up named routes

	/*Set up a named route to a specific controller and action method */
	public static routes = array(
		'namedroute' => 'controller#action'
	)

	/*Set up a named route to a specific controller and action method with a url parameter */
	public static routes = array(
		'namedroute' => 'controller#action{id}'
	)

	/*Set up a named route to a specific controller that runs default action from config-file */
	public static routes = array(
		'namedroute' => 'controller'
	)

#####Accessing Routes
Declared routes can be accessed by the Static method getRoute(), this will return a valid relative path to that route
I'm aware that static methods are not prefered but I want routes to be accessable from all over the application since its such a important path of the core.
One might also argue that accessing routes with string values creates string dependencies, but in order to get rid of those One would have to add a huge list of constants somewhere with all valid route-calls wich in turn would create a dependency to that list of constants and their variable names. I don't find that the least effective.

######Get root-route

	/*Return relative path to root declared in routes */
	\Routes::getRoute('root');

######Get a named route

	/*Return relative path of named route*/
	\Routes::getRoute('namedroute');

######Get controller route

	/*Return relative path to a controller and its default action method*/
	\Routes::getRoute('controller');

######Get route to controller and action method

	/*Return relative path to action method in controller*/
	\Routes::getRoute('controller#action');

######Get route to action method in controller with parameter

	/*Returns relative path to action method using a parameter 123*/
	\Routes::getRoute('controller#action', array('id' => 123));


####Controllers
All controllers should inherit from the Application controller class wich in turn inherits from the base controller, but one can choose to inherit straight from the base class aswell.

#####Base controller
Located in /lib/controller.php
Houses the default behaviour for controllers as well as methods used by the dispatcher to run the application

######Redirects
All controllers can redirectTo-method in order to run a header location request to another path. This is useful for example after a successful operation was executed and the program wants to redirect the user to a desired location in the application

	/*In controller method*/
	$this->redirectTo('controller', 'action');

######Helper
Not yet a big component of the framework but a small one for sessions is in place for demonstration and testning.
If one for example wants to handle session variables, simply declare that helper session should be included and the class is available within the controller


	namespace controllers;
	class myController extends \core\Appcontroller{
		public helpers = array('Session');
		public function index(){
			$this->Session->set('session_variable_name', $value);
			$this->Session->delete('session_variable_name');
		}
	}

####Views
All Views should inherit from the AppView class in the core that in turn inherits from the base view class.
The base View class handles application wide functionality for both the dispatcher, LayoutView and "application-view" classes.
In a Controller one can tell the view to give access to variables needed for rendering.
It is also prefered to use the view to access $_POST variables, here one can decide if they want the post as a array or converted into an "anonymus" object(stdClass-object) depending on purpose.

#####Get $_POST


	namepsace controllers;
	class MyController extends \core\AppController{
		public function index(){
			$postAsObject = $this->view->getPost();
			$postAsArray = $this->view->getPost(true);
		}
	}

#####AppView class
The AppView is for application wide functionality such as declaring CSS and javascript files for the entire application. One can also choose to add their own application wide methods here.

#####Rendering Views
The main purpose with views are to render content. This framwork offers two (and a half) ways to do that!
The half, may not be prefered but the controller can it self simply return a string and it will be renderd in the layout.

#####Render with string in a View class
Simply create a method in the viewclass with the same name as the controller and have it return what ever content you want to render. This is the most straight forward way to work with views.


	namepsace controllers;
	class MyController extends \core\AppController{
		public function index(){
			$postAsObject = $this->view->getPost();
			return $this->view->index($postAsObject);
		}
	}


	namespace views;
	class MyView extends \core\AppView{
		public function index(object){
			//... object html etc
			return $html;
		}
	}


#####Render with a view file
One can also create separate view files for each controller action method in order to separate views even more. Variables needed for rendering can be passed to the view-class to make them accessable to the rendering file.

Create a renderfile with the same name as the action method

app/controllers/my_controller.php

	namepsace controllers;
	class MyController extends \core\AppController{
		public function index(){
			$postAsObject = $this->view->getPost();
			$this->view->setVar('object', $postAsObject);
			//no return makes dispatcher render view file 
		}
	}


app/views/my_view.php

	namespace views;
	class MyView extends \core\AppView{
		//empty
	}

/app/views/My/index.php

	<h1><?= $object->name ?></h1>
	<p><?= $object->description ?></p>

