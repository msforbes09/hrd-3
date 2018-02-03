<?php
require_once 'function.php';
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	(qc_status >= :date or qc_status is Null )
	and
	(control_num like :keyword or 
	remark like :keyword)");
	$stmt->bindValue(':keyword', '%'.$_REQUEST["search"].'%', PDO::PARAM_STR);
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();
	echo '<div class="item_count"><span class="count">' . $stmt->rowCount() .'</span> record/s found.</div>';
	$content = '';
	$count = 1;
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$content .= '<tr id="data_' . $row["data_id"] . '" class="' . pend($row["plan_status"]) . '" title="' . $row["remark"] . '">';
		$content .= '<td class="f_bold x_3">'. $count .'.</td>';
		$content .= '<td class="x_8">'. $row["date_rec"] .'</td>';
		$content .= '<td class="x_15">'. $row["control_num"] . comment($row["remark"]) .'</td>';
		//$content .= '<td>'. $row["tsubo"] .'</td>';
		//$content .= '<td>'. $row["priority"] .'</td>';
		$content .= '<td class="x_8">'. $list_nick_name[$row["design_staff"]] .'</td>';
		$content .= '<td class="x_8">'. check_stat($row["design_staff"],$row["design_status"]) .'</td>';
		$content .= '<td class="x_8">'. $list_nick_name[$row["encode_staff"]] .'</td>';
		$content .= '<td class="x_8">'. check_stat($row["encode_staff"],$row["encode_status"]) .'</td>';
		$content .= '<td class="x_8">'. $list_nick_name[$row["check_staff"]] .'</td>';
		$content .= '<td class="x_8">'. check_stat($row["check_staff"],$row["check_status"]) .'</td>';
		$content .= '<td class="s_survey x_5">'. $row["site_survey"] .'</td>';
		$content .= '<td class="x_8">'. $list_nick_name[$row["qc_staff"]] .'</td>';
		$content .= '<td class="x_8">'. check_stat($row["qc_staff"],$row["qc_status"]) .'</td>';
		$content .= '<td class="x_5">'. $row["plan_status"] .'</td>';
		//$content .= '<td>'. $row["remark"] .'</td>';
		$content .= '</tr>';
		$count += 1;
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<div class="bg_head">
	<table class="my_table">
		<thead>
			<tr>
				<th class="x_3">No.</th>
				<th class="x_8">Received</th>
				<th class="x_15">Control #</th>
				<th id="d_head" colspan="2" class="x_16">Designing</th>
				<th id="e_head" colspan="2" class="x_16">Encoding</th>
				<th id="c_head" colspan="2" class="x_16">Checking</th>
				<th class="x_5">SS</th>
				<th id="q_head" colspan="2" class="x_16">Quality Check</th>
				<th class="x_5">Status</th>
			</tr>
		</thead>
	</table>
</div>
<div class="scroll" style="height:580px;">
	<table class="my_table">
		<tbody>
			<?php echo $content; ?>
		</tbody>
	</table>
</div>