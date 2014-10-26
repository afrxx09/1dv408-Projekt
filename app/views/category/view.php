<h2><?= $category->name ?></h2>

<h3>Beskrivning</h3>
<p><?= $category->description ?></p>

<h3>Produkter</h3>
<p><a href="<?= \Routes::getRoute('category') ?>">Tillbaka</a></p>
<div class="category-products">
	<?php
	if($products !== null){
		foreach($products as $product){
		?>
		<a class="category-product" href="<?= \Routes::getRoute('product#view', array('id'=> $product->id)) ?>">
			<div class="product-header">
				<h4><?= $product->name ?></h4>
			</div>
			<div class="product-image">
				<img src="<?= ROOT_PATH ?>pub/images/no-image.png" alt="No image: image missing." />
			</div>
		</a>
		<?php
		}
	}
	else{
	?>
		<div>Finns inga produkter.</div>
	<?php } ?>
</div>
<div class="clear"></div>
<p><a href="<?= \Routes::getRoute('category') ?>">Tillbaka</a></p>