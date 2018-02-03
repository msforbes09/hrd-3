<?php
require_once 'function.php';
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	kibiroi = 2
	and
	control_num like :keyword");
	$stmt->bindValue(':keyword', '%'.$_REQUEST["search"].'%', PDO::PARAM_STR);
	$stmt->execute();
	echo '<div class="item_count"><span class="count">' . $stmt->rowCount() .'</span> record/s found.</div>';
	$content = '';
	$count = 1;
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$content .= '<tr id="data_' . $row["data_id"] . '" title="' . $row["remark"] . '">';
		$content .= '<td class="f_bold no_w">'. $count .'.</td>';
		$content .= '<td class="cnum_w c_num">'. $row["control_num"] . comment($row["remark"]) .'</td>';
		$content .= '<td class="staff_w">'. $list_nick_name[$row["check_staff"]] .'</td>';
		$content .= '<td class="order_w">'. $row["check_status"] .'<span class="glyphicon glyphicon-edit pull-right order-icon" title="Click to Order."></span></td>';
		$content .= '</tr>';
		$count += 1;
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<div class="bg_error">
	<table class="my_table">
		<thead>
			<tr>
				<th colspan="4" style="font-size:1.5em;">Error List</th>
			</tr>
			<tr>
				<th class="no_w">No.</th>
				<th class="cnum_w">Control #</th>
				<th class="staff_w">Checker</th>
				<th class="order_w">Date Encountered</th>
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