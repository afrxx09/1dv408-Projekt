#Usecase - LayoutView

##Preconditions
1. UC1-4 in Usecase "Views"

##UC1 - Adding HTML to layout
1. Open the default layout file "app/layout/default.php"
2. Add some HTML-structe around the content-tag "<?= $this->get('content') ?>"
3. Visit root-path (localhost/myProject/)


app/layout/default.php

	...
	<body
		<div id="wrap">
			<div id="header"><h1>Title</h1></div>
			<div id="nav">nav goes here</div>
			<div id="main">
				<?= $this->get('content') ?>
			</div>
			</div id="footer"></div>
		</div>
	</body>
	...

####Expected outcome
	* View the source code to see that the html added in default.php was renderd
	* The div-tag with id "main" should contain content from "app/views/pages/start.php"


##UC2 - Adding partial
1. Create a new file called "nav.php" in folder "app/layout/"
2. Add a list of HTML-links to the file.
3. Add partial to div-tag with id "nav" insead of the current text in default.php in "app/layout/"
3. Visit root-path (localhost/myProject/)

app/layout/nav.php

	<ul>
		<li><1 href="#">link 1</a></li>
		<li><1 href="#">link 2</a></li>
	</ul>

app/layout/default.php

	...
	<div id="nav">
		<?= $this->partial('nav') ?>
	</div>
	...

####Expected outcome
	* The startpage should now have a list of two links above the main content

