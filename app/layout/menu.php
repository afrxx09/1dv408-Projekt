<div id="nav">
	<ul>
		<li><a href="<?= \Routes::getRoute('root'); ?>">Start</a></li>
		<li><a href="<?= \Routes::getRoute('pages#categories'); ?>">Kategorier</a></li>
		<li><a href="<?= \Routes::getRoute('pages#contact'); ?>">Kontakt</a></li>
		<?php if(isset($_SESSION['admin']) && $_SESSION['admin']){ ?>
		<li><a href="<?= \Routes::getRoute('pages#logout'); ?>">Logout</a></li>
		<?php } else { ?>
		<li><a href="<?= \Routes::getRoute('pages#login'); ?>">Login</a></li>
		<?php } ?>
	</ul>
	<div class="clear"></div>
</div>