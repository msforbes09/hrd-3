 <?php
require_once 'function.php';
$page_number = $_REQUEST["page_number"];
$page_start = ($page_number - 1) * 100;
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select count(*) from fd_monitoring
	where
	qc_status < :date
	and
	(control_num like :keyword or 
	remark like :keyword)");
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->bindValue(':keyword', '%'.$_REQUEST["search"].'%', PDO::PARAM_STR);
	$stmt->execute();
	$total_count = $stmt->fetch(PDO::FETCH_ASSOC)["count(*)"];
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	qc_status < :date
	and
	(control_num like :keyword or 
	remark like :keyword)
	order by qc_status desc
	limit $page_start , 100");
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->bindValue(':keyword', '%'.$_REQUEST["search"].'%', PDO::PARAM_STR);
	$stmt->execute();
	echo '<div class="item_count">Showing <span class="count">' . ($page_start + 1) . ' - ' . ($page_start + $stmt->rowCount()) . '</span> of <span class="count">' . $total_count .'</span> record/s.</div>';
	$content = '';
	$count = $page_start + 1;
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$content .= '<tr title="' . $row["remark"] . '">';
		$content .= '<td class="f_bold x_5">'. $count .'.</td>';
		$content .= '<td class="x_11">'. $row["date_rec"] .'</td>';
		$content .= '<td class="x_15">'. $row["control_num"] . comment($row["remark"]) .'</td>';
		//$content .= '<td>'. $row["tsubo"] .'</td>';
		//$content .= '<td>'. $row["priority"] .'</td>';
		$content .= '<td class="x_8">'. $list_nick_name[$row["design_staff"]] .'</td>';
		$content .= '<td class="x_8">'. $row["design_status"] .'</td>';
		$content .= '<td class="x_8">'. $list_nick_name[$row["encode_staff"]] .'</td>';
		$content .= '<td class="x_8">'. $row["encode_status"] .'</td>';
		$content .= '<td class="x_8">'. $list_nick_name[$row["check_staff"]] .'</td>';
		$content .= '<td class="x_8">'. $row["check_status"] .'</td>';
		$content .= '<td class="x_5">'. $row["site_survey"] .'</td>';
		$content .= '<td class="x_8">'. $list_nick_name[$row["qc_staff"]] .'</td>';
		$content .= '<td class="x_8">'. $row["qc_status"] .'</td>';
		//$content .= '<td>'. $row["plan_status"] .'</td>';
		//$content .= '<td>'. $row["remark"] .'</td>';
		$content .= '</tr>';
		$count += 1;
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
$page_count = round($total_count / 100);
if ($total_count % 100 < 50){
	$page_count += 1; 
}
?>
	<table class="my_table">
		<thead>
			<tr>
				<th class="x_5">No.</th>
				<th class="x_11">Received</th>
				<th class="x_15">Control #</th>
				<th colspan="2" class="x_16">Designing</th>
				<th colspan="2" class="x_16">Encoding</th>
				<th colspan="2" class="x_16">Checking</th>
				<th class="x_5">SS</th>
				<th colspan="2" class="x_16">Quality Check</th>
			</tr>
		</thead>
	</table>
<div class="scroll" style="height:570px;">
	<table class="my_table">
		<tbody>
			<?php echo $content; ?>
		</tbody>
	</table>
</div>
<div class="my_paging">
	<span class="prev_page">Prev</span>
	| <span id="index_page"><?php echo $page_number; ?></span>/<span id="last_page"><?php echo $page_count; ?></span> |
	<span class="next_page">Next</span>
</div>
