<h2>Add category</h2>
<?= isset($flash) ? $flash : '' ?>
<div>
	<form method="post" action="<?= \Routes::getRoute('category#create') ?>">
		<div class="form-row">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" />
		</div>
		<div class="form-row">
			<label for="description">Description</label>
			<input type="text" name="description" id="description" />
		</div>
		<div class="form-row">
			<input type="submit" value="save" />
		</div>
	</form>
</div>