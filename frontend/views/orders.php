<?php include_once("header.php"); ?>

<div class="user-sub-navigation">
    <ul>
        <li><a href="../orders?orderStatus=1" class=<?php echo $_REQUEST["orderStatus"] == 1 ? "selected" : "" ?>><?php echo __('Confirmed', 'wer_pk') ?> <span class="confirmed-orders" id="assignment-count"><?php echo count($ordersConfirmed); ?></span></a></li>
        <li><a href="../orders?orderStatus=2" class=<?php echo $_REQUEST["orderStatus"] == 2 ? "selected" : "" ?>><?php echo __('Pending', 'wer_pk') ?></a></li>
        <li><a href="../orders?orderStatus=3" class=<?php echo $_REQUEST["orderStatus"] == 3 ? "selected" : "" ?>><?php echo __('Processed', 'wer_pk') ?></a></li>
        <li><a href="../orders?orderStatus=4" class=<?php echo $_REQUEST["orderStatus"] == 4 ? "selected" : "" ?>><?php echo __('All', 'wer_pk') ?></a></li>
    </ul>
</div>

<?php if (count($results) > 0): ?>
<div class="wrap" style="max-width: 100%;">
    <div id="wp_wer_pk_products_table">
        <?php 
        // Initialize an array to group results by bill number
        $groupedResults = [];
        foreach ($results as $result) {
            $groupedResults[$result->billNo][] = $result;
        }

        // Loop through each unique bill number
        foreach ($groupedResults as $billNo => $billOrders): 
            $totalOrderPrice = 0; // Initialize total order price for this bill
        ?>
            <table width="100%" cellpadding="5" cellspacing="3" border='0'>
                <tr>
                    <td width="45%">
                        <p><small><?php echo __('Reference Bill #:', 'wer_pk') ?> <strong><?php echo $billNo ?></strong></small></p>
                    </td>
                    <td width="10%"></td>
                    <td width="45%">
                        <p>
                            <small><?php echo __('Bill Date:', 'wer_pk') ?> <?php echo $billOrders[0]->billdate ?></small><br>
                            <?php if ($billOrders[0]->confirmed): ?>
                                <small style="color: white; padding: 5px 10px; background: green; border-radius: 5px;"><?php echo $billOrders[0]->processed == 1 ? __('Processed Successfully', 'wer_pk') : __('Confirmed', 'wer_pk') ?></small>
                            <?php endif; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p><small><?php echo __('Description:', 'wer_pk') ?> <?php echo $billOrders[0]->description ?></small></p>
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="5" cellspacing="3" border='0' class="sellerTable">
                <tr>
                    <th><strong><?php echo __('Id', 'wer_pk') ?></strong></th>
                    <th><strong><?php echo __('Bill Id', 'wer_pk') ?></strong></th>
                    <th><strong><?php echo __('Product Id', 'wer_pk') ?></strong></th>
                    <th><strong><?php echo __('Material Name', 'wer_pk') ?></strong></th>
                    <th><strong><?php echo __('Quantity', 'wer_pk') ?></strong></th>
                    <th><strong><?php echo __('GST', 'wer_pk') ?></strong></th>
                    <th><strong><?php echo __('Order Price', 'wer_pk') ?></strong></th>
                    <th><strong><?php echo __('Discount %', 'wer_pk') ?></strong></th>
                    <?php echo $billOrders[0]->processed != 1 && $_REQUEST["orderStatus"] == 1 ? "<th></th>" : "" ?>
                </tr>

                <?php foreach ($billOrders as $order): 
                    $totalOrderPrice += $order->totalPrice; // Accumulate total order price
                ?>
                    <tr>
                        <td><?php echo $order->order_id ?></td>
                        <td><?php echo $order->billid ?></td>
                        <td><?php echo $order->productid ?></td>
                        <td><?php echo $order->materialsName ?></td>
                        <td><?php echo $order->quantity ?></td>
                        <td><span class="dashicons-before <?php echo esc_attr(Settings::set_currency_symbol()); ?>"></span>: <?php echo esc_html($order->GST); ?></td>
                        <td><span class="dashicons-before <?php echo esc_attr(Settings::set_currency_symbol()); ?>"></span>: <?php echo $order->totalPrice ?></td>
                        <td><?php echo $order->discount ?></td>
                        <?php if ($order->processed != 1 && $_REQUEST["orderStatus"] == 1): ?>
                            <td>
                                <a href="javascript:void(0);" onClick="wer_pkProcessOrder(<?php echo $order->order_id ?>, true);"><?php echo __('Processed', 'wer_pk'); ?></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                
                <tr>
                    <td colspan="6" style="text-align: right;"><strong><?php echo __('Total Order Price:', 'wer_pk') ?></strong></td>
                    <td colspan="2"><strong><span class="dashicons-before <?php echo esc_attr(Settings::set_currency_symbol()); ?>"></span>: <?php echo number_format($totalOrderPrice, 2); ?></strong></td>
                </tr>

            </table>

        <?php endforeach; ?>
    </div>
</div>
<?php else: ?>
    <strong><?php echo __('No orders Found. Please come back later.', 'wer_pk'); ?></strong>
<?php endif; ?>
