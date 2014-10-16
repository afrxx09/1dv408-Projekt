Categories
<ul id="category-list">
<?php foreach ($categories as $i => $category) { ?>
	<li><a href="<?= \Routes::getRoute('category#view', array('id' => $i+1)) ?>"><?= $category ?></a></li>
<?php } ?>
</ul>