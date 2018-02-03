<?php
require_once 'function.php';
?>
<table class="my_table">
	<tbody>
		<tr>
			<th style="width:10%">EXPECTED</th>
			<th style="width:5%"><?php echo get_expected($_REQUEST["team_id"]); ?></th>
			<th style="width:12%">DESIGNING<div class="my_badge"><?php echo get_design_balance($_REQUEST["team_id"],'design_status'); ?></div></th>
			<th style="width:12%">ENCODING<div class="my_badge"><?php echo get_process_balance($_REQUEST["team_id"],'design_status','encode_status'); ?></div></th>
			<th style="width:12%">CHECKING<div class="my_badge"><?php echo get_process_balance($_REQUEST["team_id"],'encode_status','check_status'); ?></div></th>
			<th style="width:12%">Q.C.<div class="my_badge"><?php echo get_process_balance($_REQUEST["team_id"],'check_status','qc_status'); ?></th>
			<th rowspan="3" class="" style="width:37%; text-align: center;"><?php echo get_comment($_REQUEST["team_id"]); ?></th>
		</tr>
		<tr>
			<th>RECEIVED</th>
			<th><?php echo get_received($_REQUEST["team_id"]); ?></th>
			<th rowspan="5" class="th_individual">
				<?php echo get_output($_REQUEST["team_id"],'design'); ?>
			</th>
			<th rowspan="5" class="th_individual">
				<?php echo get_output($_REQUEST["team_id"],'encode'); ?>
			</th>
			<th rowspan="5" class="th_individual">
				<?php echo get_output($_REQUEST["team_id"],'check'); ?>
			</th>
			<th rowspan="5" class="th_individual">
				<?php echo get_output($_REQUEST["team_id"],'qc'); ?>
			</th>
		</tr>
		<tr>
			<th>RELEASED</th>
			<th><?php echo get_released($_REQUEST["team_id"]); ?></th>
		</tr>
		<tr>
			<th>BALANCE</th>
			<th><?php echo get_balance($_REQUEST["team_id"],'qc_status'); ?></th>
			<th rowspan="3" class="" style="text-align: center;"><?php echo get_comment(1); ?></th>
		</tr>
		<tr>
			<th>PENDING</th>
			<th><?php echo get_pending($_REQUEST["team_id"]); ?></th>
		</tr>
		<tr>
			<th>ON-GOING</th>
			<th><?php echo get_ongoing($_REQUEST["team_id"]); ?></th>
		</tr>
	</tbody>
</table>