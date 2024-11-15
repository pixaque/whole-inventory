﻿<?php
	if(0 < count( $results )){
?>
<div class="wrap">
<div class="wp-list-table widefat fixed striped table-view-list posts" id="wp_wer_pk_project_detail_table">

	<table class="wp-list-table widefat fixed striped table-view-list pages">
		<tr >
			<th scope="col" class="manage-column column-title column-primary sortable desc"><strong><?php echo __('Id', 'wer_pk') ?></strong></th>
			<th scope="col" id="project_name" class="manage-column column-title column-primary sortable desc" abbr="Project Name">
				<a href="admin.php?page=wp_wer_pk_project_detail<?php echo "&project=".$_GET['project']; ?><?php echo isset($_GET['paged']) ? "&paged={$_GET['paged']}" : ""; ?><?php echo isset($_GET['order']) ? $_GET['order'] == "desc" ? "&order=asc" : "&order=desc" : "&order=asc" ?>">
					<span><strong><?php echo __('Bill No', 'wer_pk') ?></strong></span>
					<span class="sorting-indicators">
						<span class="sorting-indicator asc" aria-hidden="true"></span>
						<span class="sorting-indicator desc" aria-hidden="true"></span>
					</span> 
					<span class="screen-reader-text">
						<?php echo __('Sort ascending.', 'wer_pk') ?>
					</span>
				</a>
			</th>
			<th scope="col" id="size" abbr="size" class="manage-column column-title column-primary sortable desc"><strong><?php echo __('Description', 'wer_pk') ?></strong></th>
			<th scope="col" id="location" abbr="location" class="manage-column column-title column-primary sortable desc"><strong><?php echo __('Expense Type', 'wer_pk') ?></strong></th>
			<th scope="col" id="status" abbr="status" class="manage-column column-title column-primary sortable desc"><strong><?php echo __('Bill Date', 'wer_pk') ?></strong></th>
			<th scope="col" id="status" abbr="status" class="manage-column column-title column-primary sortable desc"><strong><?php echo __('Order Price', 'wer_pk') ?></strong></th>

		</tr>

<?php
$wp_list_table = new WP_Projects_Detail_List_Table( );

$wp_list_table->prepare_items();

?>


<p class="search-box">
	<form id="posts-filter" method="post">
		<label class="screen-reader-text" for="projects-search-input"><?php echo __('Search Projects:', 'wer_pk') ?></label>
		<input type="search" id="projects-search-input" name="s" value="">
		<input type="submit" id="search-submit" class="button" value="<?php echo __('Search Projects', 'wer_pk') ?>">
	</form>
</p>	

	<?php $wp_list_table->display(); ?>
<?php
	} else {	
?>
	<strong>
		<?php echo __('No projects Found. Please start adding projects.', 'wer_pk') ?>
	</strong>
<?php
		
	}
?>
</div>
</div>