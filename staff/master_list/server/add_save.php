<?php
/*
print_r ($_REQUEST);
*/
	try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO staff
			(id_num, first_name, middle_name, last_name, nick_name, employment_stat, job_cate, team, job_desc, password, image)
			VALUES
			(:id_num, :first_name, :middle_name, :last_name, :nick_name, :employment_stat, :job_cate, :team, :job_desc, :password, :image)");
	$stmt->bindValue(':id_num', $_REQUEST["id_num"], PDO::PARAM_STR);
	$stmt->bindValue(':first_name', $_REQUEST["first_name"], PDO::PARAM_STR);
	$stmt->bindValue(':middle_name', $_REQUEST["middle_name"], PDO::PARAM_STR);
	$stmt->bindValue(':last_name', $_REQUEST["last_name"], PDO::PARAM_STR);
	$stmt->bindValue(':nick_name', $_REQUEST["nick_name"], PDO::PARAM_STR);
	$stmt->bindValue(':employment_stat', $_REQUEST["employment_stat"], PDO::PARAM_INT);
	$stmt->bindValue(':job_cate', $_REQUEST["job_cate"], PDO::PARAM_INT);
	$stmt->bindValue(':team', $_REQUEST["team"], PDO::PARAM_INT);
	$stmt->bindValue(':job_desc', $_REQUEST["job_desc"], PDO::PARAM_INT);
	$stmt->bindValue(':password', md5($_REQUEST["id_num"]), PDO::PARAM_STR);
	$stmt->bindValue(':image', 'none.jpg', PDO::PARAM_STR);
	$stmt->execute();
	
}catch( PDOException $e ){
	echo $e->getMessage();
	
}
$pdo = null; 
?>