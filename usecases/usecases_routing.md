#Usecases - Routing

##Adding routes

###Preconditions
1. PHP websever with MySQL
2. Framework installed in a folder www folder where it can be run (example: \www\myProject)
3. Go to lib-folder and rename "_example_config.php" to "config.php"
4. Open file and change settings for DEAFULT_CONTROLLER and DEFAULT_ACTION if you wish.

###UC1 - Adding root route
1. Find and open file: /app/routes.php
2. Find the "private static $routes array"
3. Add key "root" with value"''"(empty string) to array ```'root' => '' ´´´
4. Go to web broswer and visit the root path of project

####Expected outcome
	Exception error: Can not find controller class "welcome"( or what ever was set as DEFAULT_CONTROLLER )

###UC2 - Adding route to controller and action
1. UC1: step 1 and 2
2. Add key 'myRoute' => 'myController#theAction'
3. go to the relative url of the projekt: "mycontroller/theaction" (example: localhost/myProject/myController/theaction)

####Expected outcome
	Exception error: Can not find controller class "myController"

###UC3 - Adding adding standard routes for controller
1. UC1: step 1 and 2
2. Add key 'category' => 'all'
3. Visit the following relative url's of the projekt:
	* "category" (example: localhost/myProject/category)
	* "category/add" (example: localhost/myProject/category/add)
	* "category/create" (example: localhost/myProject/category/create)
	* "category/save" (example: localhost/myProject/category/save)
	* "category/edit/3"  (example: localhost/myProject/category/edit/3)
	* "category/delete/2" (example: localhost/myProject/category/delete/2)
	* "category/view/1" (example: localhost/myProject/category/view/1)
	

####Expected outcome
	Exception error: Can not find controller class "category"

####Alternative Scenarios
Visit standardroute with parameter without supplying paramater in url path
3.1 Visit the folowing relative url's:
	* "category/edit"  (example: localhost/myProject/category/edit)
	* "category/delete" (example: localhost/myProject/category/delete)
	* "category/view" (example: localhost/myProject/category/view)

####Expected outcome
	Exception error: Can not find controller class "category"

###UC4 - Adding selection of standard routes for controller 
1. UC1: step 1 and 2
2. Add key 'product' => array('index', 'view', 'add')
3. Visit relative path
	* "product" (example: localhost/myProject/product/)
	* "product/view/1" (example: localhost/myProject/product/view/1)
	* "product/add" (example: localhost/myProject/product/add)

####Expected outcome
	Exception error: Can not find controller class "product"
	Exception error: Can not find controller class "product"
	Exception error: Can not find controller class "product"

####Alternative Scenarios
3. Visit the folowing relative url's:
	1. "product/view" (example: localhost/myProject/product/view)
		* Exception error: Can not find controller class "product"
	2. "product/index" (example: localhost/myProject/product/index)
		* Exception error: Can not find controller class "product"

## Bulding controllers and accessing action methods with routes

### Preconditions
* UC 1-4 Adding routes(Need routes to be set before controllers are accessable)

###UC5 - Create default controller
1. Create a default controller class called "WelcomeController"  that inherits(extends) from \core\AppController with filename "welcome_controler.php" and save it in "www\myProject\app\controllers\"
2. Add namespace controllers;
3. Add a public method called "index" and for now just let it echo out "index"

welcome_controller.php :

	namespace controllers;
	class WelcomeController{
		public function index(){
			echo 'index';
		}
	}

3. Visit root path of project "localhost/myProject/"

####Expected outcome
	output: 'index'

####Alternative scenarios
2.1.1 Do not add index-method to controller
2.1.2 Visit root path of project
####Expected outcome
	Exception Error: Could not find action: index in controller: welcome

###UC6 - Create controller tha uses standard routes
1. Create a controller class called "CategoryController" that inherits(extends) from \core\AppController
2. Add namespace controllers;
3. Save it as "category_controller.php" it in folder "www\myProject\app\controllers\"
4. Add public methods for "index", "view", "add", "create", "edit", "save", "delete"

category_controller.php:

	namespace controllers;
	class CategoryController extends \core\AppController{
		public function index(){ echo 'index'; }
		public function view(){ echo 'view: ' . $this->params[0]; }
		public function add(){ echo 'add'; }
		public function create(){ echo 'create'; }
		public function edit(){ echo 'edit' . $this->params[0]; }
		public function save(){ echo 'save'; }
		public function delete(){ echo 'delete' . $this->params[0]; }
	}

5. Visit all paths from Use Case 3 step 3 including also alternative scenarios

####Expected outcomes from regular UC3 scenarios

	'index'
	'view: 1'
	'add'
	'create'
	'edit: 3'
	'save'
	'delete: 2'

####Expected outcome from UC3 Alternative scenarios
	
	Exception error: "Action: edit in controller: category requires a parameter"
	Exception error: "Action: delete in controller: category requires a parameter"
	Exception error: "Action: view in controller: category requires a parameter"

####Alternative scenarios
5.1 Visit non existing route for category
	* Visit relative path "category/noaction"  (example: localhost/myProject/category/noaction)
####Expected outcome
	Exception error: 'No route for action: noaction in controller: category

5.2 Visit existing standard route but missing action method
	* From CategoryController class, delete the "add" method.
	* Visit relative path "category/add"  (example: localhost/myProject/category/add)
####Expected outcome
	Exception error: 'Could not find action: add in controller: category

###UC7 - Create controller with specific standard actions

1. Create a controller class called "ProductController" that inherits(extends) from \core\AppController
2. Add namespace controllers;
3. Save it as "product_controller.php" it in folder "www\myProject\app\controllers\"
4. Add public methods for "index", "view", "add"

product_controller.php:

	namespace controllers;
	class ProductController extends \core\AppController{
		public function index(){ echo 'index'; }
		public function view(){ echo 'view: ' . $this->params[0]; }
		public function add(){ echo 'add'; }
	}

5. Visit these paths:
	* "product"  (example: localhost/myProject/product)
	* "product/view/1" (example: localhost/myProject/product/view/1)
	* "product/add" (example: localhost/myProject/product/add)
#### Expected output
	
	'index'
	'view: 1'
	'add'

#### Alternative scenarios

5.1 Visit non exsisting route for product
	* Visit relative path "product/noaction"  (example: localhost/myProject/product/noaction)
####Expected outcome
	Exception error: 'No route for action: noaction in controller: product

5.2 Visit non exsisting route for a standard action in product
	* Visit relative path "product/create"  (example: localhost/myProject/product/create)
####Expected outcome
	Exception error: 'No route for action: create in controller: product

5.3 Visit exsisting standard route for product that is missing action method
	* delete "add" method from "ProductController"-class
	* Visit relative path "product/add"  (example: localhost/myProject/product/add)
####Expected outcome
	Exception error: 'Could not find action: add in controller: product




## Building links with routes

### Preconditions
* UC 1-4 Adding routes
* UC 5-7 Bulding controllers and accessing action methods with routes

###UC8 - Getting regular named route
1.In the WelcomeController's index-method. replace content with:

welcome_controller.php:
	
	echo \Routes::getRoute('root');

2.Visit root path of project ( example: localhost/myProject)

####Expected outcome
	
	'/myProject/'

####Alternative Scenarios
1.1Get non exsisting named route
	* In the WelcomeController's index-method. replace content with:

welcome_controller.php:
	
	echo \Routes::getRoute('not_a_route_name');

2.Visit root path of project ( example: localhost/myProject)

####Expected outcome
	
	Exception Error: Route does not exsist: not_a_route_name

###UC9 - Getting controller route
1.In the WelcomeController's index-method. replace content with:

welcome_controller.php:
	
	echo \Routes::getRoute('category');

2.Visit root path of project ( example: localhost/myProject)

####Expected outcome
	
	'/myProject/category/'

###UC10 - Getting controller route to specific action
1.In the WelcomeController's index-method. replace content with:

welcome_controller.php:
	
	echo \Routes::getRoute('category#add');

2.Visit root path of project ( example: localhost/myProject)

####Expected outcome
	
	'/myProject/category/add/'

####Alternative Scenarios
1.1Get route for non declared controller method
	* In the WelcomeController's index-method. replace content with:

welcome_controller.php:
	
	echo \Routes::getRoute('category#not_a_route');

2.Visit root path of project ( example: localhost/myProject)

####Expected outcome
	
	Exception Error: 'Route does not exsist: category#not_a_route

###UC11 - Getting controller route to action with parameter 
1.In the WelcomeController's index-method. replace content with:

welcome_controller.php:
	
	echo \Routes::getRoute('category#view', array('id' => 1););

2.Visit root path of project ( example: localhost/myProject)

####Expected outcome
	
	'/myProject/category/view/1/'

####Alternative Scenarios
1.1Get route to action with parameter but excluding the parameter
	* In the WelcomeController's index-method. replace content with:

welcome_controller.php:
	
	echo \Routes::getRoute('category#edit');

2.Visit root path of project ( example: localhost/myProject)

####Expected outcome
	
	Action: edit in controller: category requires a parameter.