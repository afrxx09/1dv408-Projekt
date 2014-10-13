#Usecases - Routing

##Adding routes
###UC1 - Adding root route
####Precondition - running PHP Webserver with Framework installed
1. Find and open file: /lib/routes.php
2. Find the "private static $routes array"
3. Add key "root" with value"''"(empty string) to array ```'root' => '' ´´´
4. Go to web broswer and visit the root path of project
###UC2 - Adding route to controller and action
###UC3 - Adding adding standard routes for controller
###UC4 - Adding selection of standard routes for controller 

## Building links with routes
###UC5 - Getting regular route
###UC6 - Getting controller route
###UC7 - Getting controller route to specific action
###UC8 - Getting controller route to action with parameter 