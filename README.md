#1dv408 - Linneaus University 2014

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

####Routing
The framework uses .htaccess to re-write paths into more SEO-friendly ones. This is also how to navigate throug applications.
Instead of accessing php-files and rendering them with paths like:

	"www.mydomain.com/app/views/categories/products/product.php?view-product=123"

The urls will be re-routed into something like this:

	"www.mydomain.com/categoies/product/123"

No get paramters, no visible file paths. More good looking and safer.

Also routes or paths has to be declared to work, trying to access paths not specified by the developer will result in a 404

	"www.mydomain.com/NotA/Valid/Path" => "404 not found"

Routes can be declared in various ways for different purposes. All routes are gatherd in a single file in the app-folder.

Setting up root paths

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

Setting up routes for a controller:

	/* Sets up routes for basic CRUD routes (index, view, add, create, edit, save, delete) */
	public static routes = array(
		'controller' => 'all'
	)


	/* Set up routes for a set of routes */
	public static routes = array(
		'controller' => array('index', add', 'delete')
	)
	