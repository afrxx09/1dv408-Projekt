<h2>Products</h2>
<ul id="product-list">
<?php foreach ($products as $product) { ?>
	<li><a href="<?= \Routes::getRoute('product#edit', array('id' => $product->id)) ?>"><?= $product->name ?></a></li>
<?php } ?>
</ul>