<?php if(isset($_SESSION['admin']) && $_SESSION['admin']){ ?>
<ul id="admin-menu">
	<li><a href="<?= \Routes::getRoute('category'); ?>">Categories</a></li>
	<li><a href="<?= \Routes::getRoute('product'); ?>">Products</a></li>
</ul>
<?php } ?>