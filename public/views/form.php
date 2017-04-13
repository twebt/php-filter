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
		
		<!-- Inner Header -->
		<div class="inner-header">
			<h1 class="brand-title"><a href="http://forms.viscomp.fb">Formmail DB</a></h1>
			<div class="row">
				<form name="search_form" method="GET" class="filter-form">
					<!-- Filter By Server -->
					<div class="col-md-2">
						<fieldset class="form-group">
							<label for="server">Filter By Server: </label>
							<select name="server" id="server" class="form-control">
								<option value="">Server</option>
								<?php 
								$unique_servers = array();

								foreach ($filter->dropdown() as $row) : 
									if (in_array($row['server'], $unique_servers)) {
										continue;
									}
									$unique_servers[] = $row['server']; 
								?>
								<?php if ($row['server']) {  ?>
								<option value="<?php echo $row['server'];?>" <?php if ($filter->url_parameters['server'] == $row['server']) echo 'selected=selected'; ?>><?php echo $row['server']; ?></option>
								<?php } endforeach; ?>
							</select>
						</fieldset>
					</div>
					<!-- Filter By Domain -->
					<div class="col-md-2">
						<fieldset class="form-group">
							<div class="filter-domain">
								<label for="domain">Filter By Domain: </label>
								<input type="text" value="<?php if ($filter->url_parameters['domain']) echo $filter->url_parameters['domain']; ?>" class="form-control" id="domain" placeholder="Example: abakus-nms.de" name="domain">
							</div>
						</fieldset>
					</div>
					<!-- Filter By Version -->
					<div class="col-md-2">
						<fieldset class="form-group">
							<label for="version">Filter By Version: </label>
							<select name="version" id="version" class="form-control">
								<option value="">Version</option>
								<?php 
								$unique_versions = array();

								foreach ($filter->dropdown() as $row) : 
									if (in_array($row['version'], $unique_versions)) {
										continue;
									}
									$unique_versions[] = $row['version']; 
								?>
								<?php if ($row['version']) { ?>
								<option value="<?php echo $row['version'];?>" <?php if ($filter->url_parameters['version'] == $row['version']) echo 'selected=selected'; ?>><?php echo str_replace(';', '', $row['version']); ?></option>
								<?php } endforeach; ?>
							</select>
						</fieldset>
					</div>
					<!-- Filter By Custom Form -->
					<div class="col-md-2">
						<fieldset class="form-group">
							<label for="custom_form">Filter By Custom Form: </label>
							<select name="custom_form" id="custom_form" class="form-control">
								<option value="">Custom Form</option>

								<?php 
								$unique_cf = array();

								foreach ($filter->dropdown() as $row) : 
									if (in_array($row['custom_form'], $unique_cf)) {
										continue;
									}
									$unique_cf[] = $row['custom_form']; 
								?>
								<?php if ($row['custom_form']) {  ?>
								<option value="<?php echo $row['custom_form'];?>" <?php if ($filter->url_parameters['custom_form'] == $row['custom_form']) echo 'selected=selected'; ?>><?php echo $row['custom_form']; ?></option>
								<?php } endforeach; ?>
							</select>
						</fieldset>
					</div>
					<!-- Filter By Framework -->
					<div class="col-md-2">
						<fieldset class="form-group">
							<div class="filter-framework">
								<label for="by_framework">Filter By Framework: </label>
								<select name="action" id="action" class="form-control">
									<option value="" selected>--- Choose ---</option>
									<?php
									$by_framework_opts = array('yes' => 'Yes',);
									foreach ($by_framework_opts as $key => $value) {
									?>
									<option value="<?php echo $key ?>" <?php if ($filter->url_parameters['action'] == $key) echo 'selected="selected"'?>><?php echo $value; ?></option>
									<?php } ?>
								</select>
							</div>
						</fieldset>
					</div>
					<!-- Filter By Id -->
					<div class="col-md-1">
						<fieldset class="form-group">
							<div class="filter-id">
								<label for="id">Filter By ID: </label>
								<input type="text" value="<?php if ($filter->url_parameters['id']) echo $filter->url_parameters['id']; ?>" class="form-control" id="id" placeholder="Example: 66" name="id">
							</div>
						</fieldset>
					</div>
					<div class="col-md-1">
						<button type="submit" class="btn btn-primary">FILTER</button>
					</div>
				</form>

				<!-- Info Results -->
				<div class="info-results">
					<div class="col-md-6 results-left">
						<div class="total-results">
							<span class="sized"><?php ($filter->get_count()['domains'][0] > 1) ? $text_domain = 'domains' : $text_domain = 'domain'; echo 'Total: ' . $filter->get_count()['domains'][0] . ' ' . $text_domain; ?></span>
						</div>
						<div class="total-per-page"><span class="sized">Per page: 50</span></div>
						<div class="total-records"><span class="sized">Total Records: <?php echo $filter->get_count()['records'][0] ?></span></div>
					</div>

					<div class="col-md-6 pagination-right">
						<div class="pagination-wrapper align-right">
							<div class="pagination"><?php echo $paginator->pagination($filter->pagination_info(), $filter->get_parameters()); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Results table -->
		<?php if ($filter->get_all()) : ?>
		<table id="datatable" class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th width="12%">Server</th>
					<th>Domain</th>
					<th width="22%">Path</th>
					<th>Version</th>
					<th>Action</th>
					<th>Good URL</th>
					<th>Mail Options</th>
					<th>Custom Form</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($filter->get_all() as $row) : ?>
				<tr class="row-id-<?php echo $row['id']; ?>">
					<td class="id"><?php echo $row['id']; ?></td>
					<td class="server <?php  if ($filter->url_parameters['server']) echo 'grey'; ?>"><?php echo $row['server']; ?></td>
					<td class="domain <?php  if ($filter->url_parameters['domain']) echo 'grey'; ?>"><?php echo $row['domain']; ?></td>
					<td class="path"><?php echo nl2br(str_replace('/var/www/vhosts/', '', $row['paths'])); ?></td>
					<td class="version <?php if ($filter->url_parameters['version']) echo 'grey'; ?>"><?php echo str_replace(';', '', $row['version']); ?></td>
					<td class="action <?php  if ($filter->url_parameters['action']) echo 'grey'; ?>"><?php echo nl2br(str_replace('/var/www/vhosts/', '', $row['actions'])); ?></td>
					<td class="good_url"><?php echo nl2br($row['good_urls']); ?></td>
					<td class="mail-options"><?php echo nl2br($row['mail_optionss']); ?></td>
					<td class="custom-form <?php if ($filter->url_parameters['custom_form']) echo 'grey'; ?>"><?php echo $row['custom_form']; ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php else: ?>
		<p class="no-results fadeInUp">No results found.</p>
		<?php endif; ?>

		<!-- Pagination -->
		<div class="pagination-wrapper align-right">
			<div class="pagination"><?php echo $paginator->pagination($filter->pagination_info(), $filter->get_parameters()); ?></div>
		</div>
	</div>

	<a id="toTop" href="#"><i class="fa fa-angle-up"></i></a>
</body>
</html>