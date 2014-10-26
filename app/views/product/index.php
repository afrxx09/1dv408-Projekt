<h2>Products</h2>
<?= isset($flash) ? $flash : '' ?>
<div id="product-list">
<?php foreach ($products as $product) { ?>
	<div class="product-row">
		<div class="product-col left">
			<a href="<?= \Routes::getRoute('product#view', array('id' => $product->id)) ?>"><?= $product->name ?></a>
		</div>
		
		<div class="product-col right">
			<a href="<?= \Routes::getRoute('product#delete', array('id' => $product->id)) ?>">Delete</a>
		</div>
		<div class="product-col right">
			<a href="<?= \Routes::getRoute('product#edit', array('id' => $product->id)) ?>">Edit</a>
		</div>
		
	</div>
<?php } ?>
</div>