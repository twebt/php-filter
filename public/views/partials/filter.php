<?php
/**
 * Template: Filter
 */
?>
<!-- Inner Header -->
<div class="inner-header">
	<h1 class="brand-title"><a href="http://forms.viscomp.fb">Formmail DB</a></h1>
	<div class="row">
		<form name="search_form" method="GET" class="filter-form clearfix">
			<!-- Filter By Server -->
			<div class="col-sm-4 col-md-6 col-lg-2">
				<fieldset class="form-group">
					<label for="server"><i class="fa fa-server"></i> Server: </label>
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
					<i class="fa fa-angle-down"></i>
				</fieldset>
			</div>
			<!-- Filter By Domain -->
			<div class="col-sm-4 col-md-6 col-lg-2">
				<fieldset class="form-group">
					<div class="filter-domain">
						<label for="domain"><i class="fa fa-globe"></i> Domain: </label>
						<input type="text" value="<?php if ($filter->url_parameters['domain']) echo $filter->url_parameters['domain']; ?>" class="form-control" id="domain" placeholder="Example: abakus-nms.de" name="domain">
					</div>
				</fieldset>
			</div>
			<!-- Filter By Version -->
			<div class="col-sm-4 col-md-6 col-lg-2">
				<fieldset class="form-group">
					<label for="version"><i class="fa fa-wrench"></i> Version: </label>
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
					<i class="fa fa-angle-down"></i>
				</fieldset>
			</div>
			<!-- Filter By Custom Form -->
			<div class="col-sm-4 col-md-6 col-lg-2">
				<fieldset class="form-group">
					<label for="custom_form"><i class="fa fa-envelope"></i> Custom Form: </label>
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
					<i class="fa fa-angle-down"></i>
				</fieldset>
			</div>
			<!-- Filter By Framework -->
			<div class="col-sm-4 col-md-6 col-lg-2">
				<fieldset class="form-group">
					<div class="filter-framework">
						<label for="by_framework"><i class="fa fa-code"></i> Framework: </label>
						<select name="action" id="action" class="form-control">
							<option value="" selected>--- Choose ---</option>
							<?php
							$by_framework_opts = array('yes' => 'Yes',);
							foreach ($by_framework_opts as $key => $value) {
							?>
							<option value="<?php echo $key ?>" <?php if ($filter->url_parameters['action'] == $key) echo 'selected="selected"'?>><?php echo $value; ?></option>
							<?php } ?>
						</select>
						<i class="fa fa-angle-down"></i>
					</div>
				</fieldset>
			</div>
			<!-- Filter By Id -->
			<div class="col-sm-4 col-md-6 col-lg-1">
				<fieldset class="form-group">
					<div class="filter-id">
						<label for="id"># ID: </label>
						<input type="text" value="<?php if ($filter->url_parameters['id']) echo $filter->url_parameters['id']; ?>" class="form-control" id="id" placeholder="Example: 66" name="id">
					</div>
				</fieldset>
			</div>
			<div class="col-sm-12 col-lg-1">
				<button type="submit" class="btn btn-primary">SEARCH</button>
			</div>
		</form>

		<!-- Info Results -->
		<div class="info-results">
			<div class="col-xs-6 results-left">
				<div class="total-results">
					<span class="sized"><?php ($filter->get_count()['domains'][0] > 1) ? $text_domain = 'domains' : $text_domain = 'domain'; echo 'Total: ' . $filter->get_count()['domains'][0] . ' ' . $text_domain; ?></span>
				</div>
				<div class="total-per-page"><span class="sized">Per page: 50</span></div>
				<div class="total-records"><span class="sized">Total Records: <?php echo $filter->get_count()['records'][0] ?></span></div>
			</div>

			<div class="col-xs-6 pagination-right">
				<div class="pagination-wrapper">
					<div class="pagination"><?php echo $paginator->pagination($filter->pagination_info(), $filter->get_parameters()); ?></div>
				</div>
			</div>
		</div>
	</div>
</div>