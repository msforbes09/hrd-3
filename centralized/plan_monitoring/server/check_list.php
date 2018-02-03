<?php
//print_r ($_REQUEST);
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	control_num = :control_num");
	$stmt->bindValue(':control_num', $_REQUEST["ctrl_num"], PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row){
		$prompt = '<h4><b><span id="ctrl_num">' . $row["control_num"] . '</span></b> already received on ' . $row["date_rec"] . '.</h4>';
		$prompt .= '<textarea id="text_note" class="form-control" placeholder="insert comment to continue!!!" style="height:300px;"></textarea>';
		$prompt .= '<input type="hidden" id="p_status" value="' . $_REQUEST["p_status"] . '" />';
		$prompt .= '<div id="err_prompt" style="color: red; text-align: center;"></div>';
		echo $prompt;
	}
	//echo $row["date_rec"];
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
/*
*/
?>