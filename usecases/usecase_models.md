#Usecase - Models

##Preconditions
* UC 1-3 in "Usecase - Views"
* MySQL databse setup with a user and password in utf-8 named for example "modeltest"
* A table in "modeltest" called "category" with fields "id" and "name"
* One or more posts in the table "category" for testing
* Change the settings in "config.php" in "www/myProject/lib/" to correct database settings
* Create a controller class named CategoryController in "app/controllers/"
* Create a Model Class named CategoryModel in "app/models/"
* Create a View Class for Category Named CategoryView  in "app/views/"

SQL - Create database

	CREATE DATABASE IF NOT EXISTS `modeltest` /*!40100 DEFAULT CHARACTER SET utf8 */;
	USE `projekt`;

	CREATE TABLE IF NOT EXISTS `category` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(50) NOT NULL,
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
	
	INSERT INTO `category` (`name`) VALUES
	(1, 'Test 1'),
	(2, 'Test 2');

app/controllers/category_controller.php

	namespace controllers;
	class CategoryController extends \core\AppController{
		public function index(){
			
		}
	}

app/models/category_model.php

	namespace models;
	class CategoryModel extends \core\AppModel{
		
	}

app/views/category_view.php

	namespace views;
	class CategoryView extends \core\AppView{
		public function index(){}
		public function view(){}
	}

##UC1 - Get and display a list of posts
1. In CategoryController index method add example code top fetch posts from database
2. send result to view file to render string
2. visit category "index"-path "localhost/myProject/category"

app/controllers/category_controller.php

	public function index(){
		$categories = $this->Category->all();
		return $this->view->index($categories);
	}

app/views/category_view.php

	public function index($categories){
		$html = '';
		foreach($categoies as $category){
			$html = '<p>' . $category->name . '</p>';
		}
		return $html;
	}

####Expected outcome:
	*Full HTML dokument with paragraph-tags containing the names of the categories in the main-content

##UC2 - Get and display a single post

... To come

##UC3 - Add(insert) a post to database

... To come

##UC4 - Edit(update) a post in database

... To come

##UC5 - Delete post from databse

... To come

##UC6 - Add Association to models

... To come