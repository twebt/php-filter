<!DOCTYPE html>
<html>
<head>
	<title>Formmail DB</title>

	<meta charset="utf-8">
	<meta name="description" content="<?php ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" href="public/favicon.ico" type="image/x-icon">
	<!-- jQuery 3.1.0 -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script>
		document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">')
	</script>
	<script>
		document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">');
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!-- Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<!-- Font Awesome -->
	<link href='https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css' rel='stylesheet' type='text/css'>
	
	<!-- Script -->
	<script src="public/assets/js/app.js"></script>
	<!-- Stylesheet -->
	<link href='public/assets/css/app.css' rel='stylesheet' type='text/css'>	
</head>

<body> 
	<div class="page-wrap">
		
		<?php require_once('filter.php'); ?>
		<?php require_once('table.php'); ?>

		<!-- Pagination -->
		<div class="pagination-wrapper align-right">
			<div class="pagination"><?php echo $paginator->pagination($filter->pagination_info(), $filter->get_parameters()); ?></div>
		</div>
	</div>

	<a id="toTop" href="#"><i class="fa fa-angle-up"></i></a>
</body>
</html>