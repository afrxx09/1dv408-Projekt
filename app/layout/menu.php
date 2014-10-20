<div id="nav">
	<ul>
		<li><a href="<?= \Routes::getRoute('root'); ?>">Start</a></li>
		<li><a href="<?= \Routes::getRoute('category'); ?>">Kategorier</a></li>
		<li><a href="<?= \Routes::getRoute('pages#contact'); ?>">Kontakt</a></li>
		<li><a href="<?= \Routes::getRoute('category#view', array('id' => 2)); ?>">Category view 2</a></li>
		<li><a href="<?= \Routes::getRoute('test', array('id' => 2)); ?>">Test</a></li>
	</ul>
	<div class="clear"></div>
</div>