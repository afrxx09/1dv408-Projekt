#Usecases - Routing

##Preconditions
1. PHP websever with MySQL
2. Framework installed in a folder www folder where it can be run (example: \www\myProject)
3. Go to lib-folder and rename "_example_config.php" to "config.php"
4. Open file and change settings for DEAFULT_CONTROLLER and DEFAULT_ACTION if you wish.
5. Change settings for database to make sure it can get access

##Adding routes
###UC1 - Adding root route
1. Find and open file: /lib/routes.php
2. Find the "private static $routes array"
3. Add key "root" with value"''"(empty string) to array ```'root' => '' ´´´
4. Go to web broswer and visit the root path of project
####Expected outcome
Exception error: Can not find controller class "welcome"( or what ever was set as DEFAULT_CONTROLLER )

###UC2 - Adding route to controller and action
1. UC1: step 1 and 2
2. Add key 'myRoute' => 'myController#theAction'
3. go to the relative url of the projekt: "mycontroller/theaction" (example: localhost/MyProject/myController/theaction)
####Expected outcome
Exception error: Can not find controller class "mycontroller"

###UC3 - Adding adding standard routes for controller
1. UC1: step 1 and 2
2. Add key 'category' => 'all'
3. Visit the following relative url's of the projekt:
	* "category" (example: localhost/MyProject/category)
	* "category/add" (example: localhost/MyProject/category/add)
	* "category/create" (example: localhost/MyProject/category/create)
	* "category/save" (example: localhost/MyProject/category/save)
####Expected outcome
Exception error: Can not find controller class "category"
####Alternative Scenarios
3. Visit the folowing relative url's:
	* "category/edit/3"  (example: localhost/MyProject/category/edit/3)
	* "category/delete/2" (example: localhost/MyProject/category/delete/2)
	* "category/view/1" (example: localhost/MyProject/category/view/1)
####Expected outcome
* Exception error: Can not find controller class "category"
####Alternative Scenarios
3.1 Visit the folowing relative url's:
	* "category/edit"  (example: localhost/MyProject/category/edit/3)
	* "category/delete" (example: localhost/MyProject/category/delete/2)
	* "category/view" (example: localhost/MyProject/category/view/1)
####Expected outcome
* Exception error: "Action: edit in controller: category requires a parameter"
* Exception error: "Action: delete in controller: category requires a parameter"
* Exception error: "Action: view in controller: category requires a parameter"

###UC4 - Adding selection of standard routes for controller 
1. UC1: step 1 and 2
2. Add key 'product' => array('index', 'add', 'delete')
3. Visit relative path
	* "product" (example: localhost/MyProject/product/)
	* "product/add" (example: localhost/MyProject/product/add)
	* "product/delete/1" (example: localhost/MyProject/product/delete/1)
####Expected outcome
	* Exception error: Can not find controller class "product"
	* Exception error: Can not find controller class "product"
	* Exception error: Can not find controller class "product"
####Alternative Scenarios
3.1 Visit the folowing relative url's:
	3.1.1 "product/delete" (example: localhost/MyProject/product/delete)
		3.1.2.1 Exception error: "Action: delete in controller: category requires a parameter"
	3.1.2 "product/index" (example: localhost/MyProject/product/index)
		3.1.2.2 Exception error: Can not find controller class "product"

## Building links with routes
###UC5 - Getting regular route
###UC6 - Getting controller route
###UC7 - Getting controller route to specific action
###UC8 - Getting controller route to action with parameter 