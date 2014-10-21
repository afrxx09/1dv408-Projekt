<h2><?= $product->name ?></h2>
<p><?= $product->description ?></p>
<p><a href="<?= \Routes::getRoute('category#view', array('id'=> $product->category_id)) ?>">Tillbaka</a></p>