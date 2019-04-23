<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<title>
			<?=
				isset($title) ? $title . ' | ' . 'WEBSITE_NAME' : 'WEBSITE_NAME';
			 ?>
		</title>
	</head>
	<body>
		<?= $content ?>
	</body>
</html>