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
	kibiroi = 1
	and
	control_num like :keyword");
	$stmt->bindValue(':keyword', '%'.$_REQUEST["search"].'%', PDO::PARAM_STR);
	$stmt->execute();
	$total_count = $stmt->fetch(PDO::FETCH_ASSOC)["count(*)"];
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	kibiroi = 1
	and
	control_num like :keyword
	order by kibiroi_order desc
	limit $page_start , 100");
	$stmt->bindValue(':keyword', '%'.$_REQUEST["search"].'%', PDO::PARAM_STR);
	$stmt->execute();
	echo '<div class="item_count">Showing <span class="count">' . ($page_start + 1) . ' - ' . ($page_start + $stmt->rowCount()) . '</span> of <span class="count">' . $total_count .'</span> record/s.</div>';
	$content = '';
	$count = $page_start + 1;
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$content .= '<tr title="' . $row["remark"] . '">';
		$content .= '<td class="f_bold no_w">'. $count .'.</td>';
		$content .= '<td class="cnum_w">'. $row["control_num"] . comment($row["remark"]) .'</td>';
		$content .= '<td class="staff_w">'. $list_nick_name[$row["check_staff"]] .'</td>';
		$content .= '<td class="order_w">'. $row["kibiroi_order"] .'</td>';
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
<div class="bg_head">
	<table class="my_table">
		<thead>
			<tr>
				<th colspan="4" style="font-size:1.5em;">Ordered List</th>
			</tr>
			<tr>
				<th class="no_w">No.</th>
				<th class="cnum_w">Control #</th>
				<th class="staff_w">Checker</th>
				<th class="order_w">Date Ordered</th>
			</tr>
		</thead>
	</table>
</div>
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