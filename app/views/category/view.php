<h2><?= $category->name ?></h2>
<h3>Beskrivning</h3>
<p><?= $category->description ?></p>
<h3>Produkter</h3>
<?php foreach($products as $product){ ?>
	<div>
		<h4><a href="<?= \Routes::getRoute('product#view', array('id'=> $product->id)) ?>"><?= $product->name ?></a></h4>
		<p><?= $product->description ?></p>
	</div>
<?php } ?>
<p><a href="<?= \Routes::getRoute('category') ?>">Tillbaka</a></p>