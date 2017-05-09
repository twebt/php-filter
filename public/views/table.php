<?php
/**
 * Template: Table
 */
?>
<!-- Results table -->
<?php if ($filter->get_all()) : ?>
<table id="datatable" class="table table-hover table-bordered">
	<thead>
		<tr>
			<th width="5%"># ID</th>
			<th width="10%" class="<?php  if ($filter->url_parameters['server']) echo 'th-active'; ?>"><i class="fa fa-server"></i> Server</th>
			<th class="<?php  if ($filter->url_parameters['domain']) echo 'th-active'; ?>"><i class="fa fa-globe"></i> Domain</th>
			<th width="22%"><i class="fa fa-link"></i> Path</th>
			<th width="5%" class="<?php  if ($filter->url_parameters['version']) echo 'th-active'; ?>"><i class="fa fa-wrench"></i> Version</th>
			<th class="<?php  if ($filter->url_parameters['action']) echo 'th-active'; ?>"><i class="fa fa-external-link"></i> Action</th>
			<th width="5%"><i class="fa fa-check"></i> Good URL</th>
			<th><i class="fa fa-cogs"></i> Mail Options</th>
			<th class="<?php  if ($filter->url_parameters['custom_form']) echo 'th-active'; ?>" width="8%"><i class="fa fa-envelope"></i> Custom Form</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($filter->get_all() as $row) : ?>
		<tr class="row-id-<?php echo $row['id']; ?>">
			<td class="id"><?php echo $row['id']; ?></td>
			<td class="server <?php  if ($filter->url_parameters['server']) echo 'td-active'; ?>"><?php echo $row['server']; ?></td>
			<td class="domain <?php  if ($filter->url_parameters['domain']) echo 'td-active'; ?>"><?php echo $row['domain']; ?></td>
			<td class="path"><?php echo nl2br(str_replace('/var/www/vhosts/', '', $row['paths'])); ?></td>
			<td class="version <?php if ($filter->url_parameters['version']) echo 'td-active'; ?>"><?php echo str_replace(';', '', $row['version']); ?></td>
			<td class="action <?php  if ($filter->url_parameters['action']) echo 'td-active'; ?>"><?php echo nl2br(str_replace('/var/www/vhosts/', '', $row['actions'])); ?></td>
			<td class="good_url"><?php echo nl2br($row['good_urls']); ?></td>
			<td class="mail-options"><?php echo nl2br($row['mail_optionss']); ?></td>
			<td class="custom-form <?php if ($filter->url_parameters['custom_form']) echo 'td-active'; ?>"><?php echo $row['custom_form']; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<p class="no-results fadeInUp">No results found.</p>
<?php endif; ?>