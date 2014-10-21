<h2>Categories</h2>
<ul id="category-list">
<?php foreach ($categories as $category) { ?>
	<li><a href="<?= \Routes::getRoute('category#view', array('id' => $category->id)) ?>"><?= $category->name ?></a></li>
<?php } ?>
</ul>