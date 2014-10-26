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