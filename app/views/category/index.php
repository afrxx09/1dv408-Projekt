<h2>Categories</h2>
<?= isset($flash) ? $flash : '' ?>
<div id="category-list">
<?php foreach ($categories as $category) { ?>
	<div class="category-row">
		<div class="category-col left">
			<a href="<?= \Routes::getRoute('category#view', array('id' => $category->id)) ?>"><?= $category->name ?></a>
		</div>
		
		<div class="category-col right">
			<a href="<?= \Routes::getRoute('category#delete', array('id' => $category->id)) ?>">Delete</a>
		</div>
		<div class="category-col right">
			<a href="<?= \Routes::getRoute('category#edit', array('id' => $category->id)) ?>">Edit</a>
		</div>
		
	</div>
<?php } ?>
</div>