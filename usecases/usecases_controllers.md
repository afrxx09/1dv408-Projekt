#Usercase Controllers

## Bulding controllers and accessing action methods with routes

### Preconditions
* UC 1-4 in "Usecase - Routes"

###UC1 - Create default controller
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

4. Visit root path of project "localhost/myProject/"

####Expected outcome
	output: 'index'

####Alternative scenarios
2.1.1 Do not add index-method to controller
2.1.2 Visit root path of project
####Expected outcome
	Exception Error: Could not find action: index in controller: welcome

###UC2 - Create controller tha uses standard routes
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

###UC3 - Create controller with specific standard actions

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