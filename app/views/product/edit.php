<h2>Edit Product</h2>
<div>
	<form method="post" action="<?= \Routes::getRoute('product#save') ?>">
		<input type="hidden" name="id" id="id" value="<?= $product->id ?>" />
		
		<div class="form-row">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" value="<?= $product->name ?>" />
		</div>
		<div class="form-row">
			<label for="description">Description</label>
			<input type="text" name="description" id="description" value="<?= $product->description ?>" />
		</div>
		<div class="form-row">
			<input type="submit" value="save" />
		</div>
	</form>
</div>