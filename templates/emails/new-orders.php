<?php
/**
 * Admin new order email
 *
 */

	$total = count((array)$message);
	echo $total;
 ?>
<div class="wrap" style="max-width: 100%;">
<div class="" id="wp_wer_pk_products_table">
	<table width="100%" cellpadding="5" cellspacing=="3" border='0' Class="sellerTable">
		<tr>
			<th><strong>Id</strong></th>
			<th><strong>Bill Id</strong></th>
			<th><strong>Store Name</strong></th>
			<th><strong>Product id</strong></th>
			<th><strong>Product</strong></th>
			<th><strong>Quantity</strong></th>
			<th><strong>GST</strong></th>
			<th><strong>Price</strong></th>
			<th><strong>Discount</strong></th>
		</tr>
		<tr>
			<td colspan="9">
				<?php print_r($message) ?>
			</td>
		</tr>
	<?php
	foreach ( $message as $result) {
	?>
		<tr>
			<td><?php echo $result->id ?></td>
			<td><?php echo $result->billid ?></td>
			<td><?php echo $result->supplierName ?></td>
			<td><?php echo $result->productid ?></td>
			<td><?php echo $result->materialsName ?></td>
			<td><?php echo $result->quantity ?></td>
			<td><span class="dashicons-before <?php echo esc_attr(Settings::set_currency_symbol()); ?>"></span>: <?php echo $result->GST ?></td>
			<td><span class="dashicons-before <?php echo esc_attr(Settings::set_currency_symbol()); ?>"></span>: <?php echo $result->totalPrice ?></td>
			<td><?php echo $result->discount ?> %</td>
		</tr>
	<?php
	}
	?>
	</table>
</div>
</div>
