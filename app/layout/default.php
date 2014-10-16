<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<?= $this->get('css') ?>
	</head>

	<body>
		<div id="wrap">
			
			<div id="header">
				<h1>Product Catalog built with Framework</h1>
			</div>
			
			<?= $this->partial('menu') ?>
			
			<div id="content">
				<?= $this->get('content') ?>
			</div>

			<div id="footer-pusher"></div>
			<div id="footer">
				<p>footer</p>
			</div>
			
		</div>
		<?= $this->get('script') ?>
	</body>

</html>