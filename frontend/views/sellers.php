<?php
	if(0 < count( $results )){
?>
<div class="wrap" style="max-width: 100%;">

	<table width="100%" Class="table">
		<thead>
			<tr>
				<th  data-column="variant_id">
					<?php echo __('Id', 'wer_pk') ?>
				</th>
				<th  data-column="materialsName" style="cursor: move;">
					<?php echo __('Product(s)', 'wer_pk') ?>   
				</th>
				<th  data-column="variantSKU">
					<?php echo __('SKU', 'wer_pk') ?>
				</th>
				<th  data-column="variantStock" style="cursor: move;">
					<?php echo __('Stock', 'wer_pk') ?>
				</th>
				<th  data-column="variantGST">
					<?php echo __('GST', 'wer_pk') ?>
				</th>
				<th  data-column="variantPrice">
					<?php echo __('Price', 'wer_pk') ?>
				</th>
				<th  data-column="variantDiscount" style="cursor: move;">
					<?php echo __('Discount', 'wer_pk') ?>
				</th>
			</tr>
		</thead>

	<?php

	foreach ( $results as $result) {
	
	?>
		<tr>
			<td><?php echo $result->variant_id ?></td>
			<!-- <td><?php echo $result->product_id ?></td> -->
			<td>
				<?php echo $result->materialsName ?><br/>
				<?php echo $result->attributes ?>				
				<?php if( ! $data['Admin'] ) { ?> 
					<div Class="actionDiv">				
						<a href="javascript:void(0);" onClick="wer_pkEditSeller(<?php echo $result->product_id ?>, <?php echo $result->variant_id ?>);">
							<span Class="dashicons-before dashicons-edit"></span><?php echo __('Edit', 'wer_pk') ?>
						</a> |
						<a href="javascript:void(0);" onClick="wer_pkDeleteSeller(<?php echo $result->product_id ?>, 'Are you sure?');">
							<span Class="dashicons-before dashicons-trash"></span><?php echo __('Delete', 'wer_pk') ?>
						</a>
					</div>
				<?php } ?>

			</td>
			<td><?php echo $result->variantSKU ?></td>
			<td><?php echo $result->variantStock ?></td>
			<td><span class="dashicons-before <?php echo esc_attr(Settings::set_currency_symbol()); ?>"></span>: <?php echo $result->variantGST ?></td>
			<td><span class="dashicons-before <?php echo esc_attr(Settings::set_currency_symbol()); ?>"></span>: <?php echo $result->variantPrice ?></td>
			<td><?php echo $result->variantDiscount ?></td>
		</tr>
<?php } ?>
	</table>
<?php

?>
<?php } else { ?>
		<strong><?php echo __('No products Found. Please start adding products.', 'wer_pk'); ?></strong>
<?php } ?>
</div>