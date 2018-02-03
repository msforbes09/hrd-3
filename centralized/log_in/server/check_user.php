<?php
session_start();
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from staff
		where
		id_num = :username
		and
		password = :password");
	$stmt->bindValue(':username', $_REQUEST["username"], PDO::PARAM_STR);
	$stmt->bindValue(':password', md5($_REQUEST["password"]), PDO::PARAM_STR);
	$stmt->execute();
	if ($stmt->rowCount() == 1){
		echo '1';
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION["id"] = $row["staff_id"];
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>