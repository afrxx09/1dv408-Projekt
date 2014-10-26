#Usercase - Routes and links

## Building links with routes

### Preconditions
* UC 1-4  in "Usecase - Routes"
* UC 1-3  in "Usercase - Controllers"

###UC1 - Getting regular named route
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

###UC2 - Getting controller route
1.In the WelcomeController's index-method. replace content with:

welcome_controller.php:
	
	echo \Routes::getRoute('category');

2.Visit root path of project ( example: localhost/myProject)

####Expected outcome
	
	'/myProject/category/'

###UC3 - Getting controller route to specific action
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

###UC4 - Getting controller route to action with parameter 
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