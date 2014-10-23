<h2>Edit Category</h2>
<div>
	<form method="post" action="<?= \Routes::getRoute('category#save') ?>">
		<input type="hidden" name="id" id="id" value="<?= $category->id ?>" />
		<div class="form-row">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" value="<?= $category->name ?>" />
		</div>
		<div class="form-row">
			<label for="description">Description</label>
			<input type="text" name="description" id="description" value="<?= $category->description ?>" />
		</div>
		<div class="form-row">
			<input type="submit" value="save" />
		</div>
	</form>
</div>