<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>
			<?= isset($title) ? $title : 'Gestion d\'erreur'; ?>
		</title>
		<link rel="stylesheet" href="css/style-error.css">
	</head>
	<body>
		<?= $content ?>
	</body>
</html>