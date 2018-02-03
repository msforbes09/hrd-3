<?php
require_once 'function.php';
require_once 'read_summary.php';
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	team_id = :team_id
	and
	(qc_status >= :date or qc_status is Null )");
	$stmt->bindValue(':team_id', $_REQUEST["team_id"], PDO::PARAM_INT);
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();
	$content = '';
	$count = 1;
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$content .= '<tr id="data_' . $row["data_id"] . '" class="update ' . pend($row["plan_status"]) . '" title="' . $row["remark"] . '">';
		$content .= '<td class="f_bold no_w">'. $count .'</td>';
		$content .= '<td class="date_rec date_w">'. $row["date_rec"] .'</td>';
		$content .= '<td class="c_num cnum_w">'. $row["control_num"] . comment($row["remark"]) .'</td>';
		//$content .= '<td>'. $row["tsubo"] .'</td>';
		//$content .= '<td>'. $row["priority"] .'</td>';
		$content .= '<td class="date_w">'. $list_nick_name[$row["design_staff"]] .'</td>';
		$content .= '<td class="date_w">'. check_stat($row["design_staff"],$row["design_status"]) .'</td>';
		$content .= '<td class="date_w">'. $list_nick_name[$row["encode_staff"]] .'</td>';
		$content .= '<td class="date_w">'. check_stat($row["encode_staff"],$row["encode_status"]) .'</td>';
		$content .= '<td class="date_w">'. $list_nick_name[$row["check_staff"]] .'</td>';
		$content .= '<td class="date_w">'. check_stat($row["check_staff"],$row["check_status"]) .'</td>';
		$content .= '<td class="ss_w">'. $row["site_survey"] .'</td>';
		$content .= '<td class="date_w">'. $list_nick_name[$row["qc_staff"]] .'</td>';
		$content .= '<td class="date_w ' . set_finished($row["qc_status"]) . '">'. check_stat($row["qc_staff"],$row["qc_status"]) .'</td>';
		$content .= '<td class="stat_w" style="padding: 0px;">';
		$content .= '<select class="p_stat">';
		$content .= '<option value="A"' . check_pstat($row["plan_status"],'A') . '>A</option>';
		$content .= '<option value="E"' . check_pstat($row["plan_status"],'E') . '>E</option>';
		$content .= '<option value="P"' . check_pstat($row["plan_status"],'P') . '>P</option>';
		$content .= '</select>';
		$content .= '</td>';
		$content .= '<td class="tools tools_w" style="padding: 0px;">';
		$content .= '<button class="remove btn_remove" title="remove"><span class="glyphicon glyphicon-trash"></span></button>';
		$content .= '<button class="comment btn_comment" title="insert comment"><span class="glyphicon glyphicon-comment"></span></button>';
		$content .= '<button class="move btn_move" title="transfer"><span class="glyphicon glyphicon-share"></span></button>';
		$content .= '</td>';
		$content .= '</tr>';
		$count += 1;
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<div class="bg_head" style="margin-top: 5px;">
	<table class="my_table">
		<thead>
			<tr>
				<th class="no_w">No.</th>
				<th class="date_w">Received</th>
				<th class="cnum_w" colspan="2">Control #</th>
				<th class="proc_head" colspan="2">Designing</th>
				<th class="proc_head" colspan="2">Encoding</th>
				<th class="proc_head" colspan="2">Checking</th>
				<th class="ss_w">SS</th>
				<th class="proc_head" colspan="2">Quality Check</th>
				<th class="stat_head" colspan="2">Status</th>
			</tr>
		</thead>
	</table>
</div>
<div class="scroll" style="height:480px;">
	<table class="my_table">
		<tbody>
			<?php echo $content; ?>
		</tbody>
	</table>
</div>