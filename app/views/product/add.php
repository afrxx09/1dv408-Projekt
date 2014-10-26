<h2>add Product</h2>
<?= isset($flash) ? $flash : '' ?>
<div>
	<form method="post" action="<?= \Routes::getRoute('product#create') ?>">
		<div class="form-row">
			<label for="category_id">Kategori</label>
			<select id="category_id" name="category_id">
				<?php foreach($categories as $category){ 
					echo '<option value="' . $category->id . '">' . $category->name . '</option>';
				} ?>
			</select>
		</div>
		
		<div class="form-row">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" value="" />
		</div>
		<div class="form-row">
			<label for="description">Description</label>
			<textarea name="description" id="description"></textarea>
		</div>
		<div class="form-row">
			<input type="submit" value="Create" />
		</div>
	</form>
</div>