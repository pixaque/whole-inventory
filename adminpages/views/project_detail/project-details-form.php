<div class="wrap" id="<?php echo esc_attr( self::MENU_SLUG ); ?>">
	
	<?php do_action('dummyNotice'); ?>

	<h1><?php esc_html_e( 'Orders', 'wer_pk' ); ?></h1>
	<form method="post" id="order_Add_Edit" action="javascript:void(0)" enctype="multipart/form-data">
		
		<input type="hidden" name="orderid" value='<?php echo !empty($data['editProject']) ? $data['editProject']->id : isset($_REQUEST['projectOrder']); ?>' />

		<input type="hidden" name="projectid" value="<?php echo !empty($data['editProject']) ? $data['editProject']->projectid: $_REQUEST["project"]; ?>" />
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
					<label class="wp-wer_pk-label"><?php _e('Order #', 'wer_pk' );?></label></br>
					<input type="text" value="<?php echo !empty($data['editProject']) ? $data['editProject']->billNo : ""; ?>" name="billNo"  required="required" />
				</td>
				<td>
					<label class="wp-wer_pk-label"><?php _e('Expense Type', 'wer_pk' );?></label></br>
					<input type="text" value="<?php echo !empty($data['editProject']) ? $data['editProject']->expenseType : "Misc";?>" name="expenseType"  required="required"/>
				</td>
				<td>
					<label class="wp-wer_pk-label"><?php _e('Order Date', 'wer_pk' );?></label>
					<input type="date" value="<?php  echo !empty($data['editProject']) ? $data['editProject']->billdate : "";?>" name="billdate"  required="required"/>
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>
					<label class="wp-wer_pk-label"><?php _e('Order Notes / Description', 'wer_pk' );?></label>
				</td>
				<td colspan="3">
					<textarea 
						cols="30" 
						rows="5" 
						name="description" 
						class="large-text" 
						required="required"><?php echo !empty($data['editProject']) ? $data['editProject']->description : ""; ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			
			<tr>
				<td colspan="4">
					<?php
						if ( isset($data['editing']) ) {
					?>
						<button 
						type="submit" 
						name="Update" 
						id="UpdateMe" 
						class="button button-secondary button-large" 
						onClick="wer_pkOrderUpdateForm();"
						>
						<?php _e('Update Changes', 'wer_pk' );?> <span class="spinner" id="mainSpinner" style="visibility: visible;"></span>
						</button>
					<?php
						} else {
					?>
						<button 
						type="submit" 
						name="Save" 
						id="SaveMe" 
						class="button button-secondary button-large"
						onClick="wer_pkOrderSaveForm();"
						>
							<?php _e('Save Order', 'wer_pk' );?>
						<span class="spinner" id="mainSpinner" style="visibility: visible;"></span>
						</button>
						
					<?php
						}
					?>
				</td>
			</tr>

		</table>


		
	</form>


</div><!--end #wrap -->