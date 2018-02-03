<?php
//print_r ($_REQUEST);
$filter = '';
if ($_REQUEST["employment_stat_filter"] != 1){
	$filter .= ' and staff.employment_stat = ' . $_REQUEST["employment_stat_filter"];
}
if ($_REQUEST["job_cate_filter"] != 1){
	$filter .= ' and staff.job_cate = ' . $_REQUEST["job_cate_filter"];
}
if ($_REQUEST["team_filter"] != 1){
	$filter .= ' and staff.team = ' . $_REQUEST["team_filter"];
}
if ($_REQUEST["job_desc_filter"] != 1){
	$filter .= ' and staff.job_desc = ' . $_REQUEST["job_desc_filter"];
}
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		staff.staff_id as staff_id,
		staff.id_num as id_num,
		staff.first_name as first_name,
		staff.middle_name as middle_name,
		staff.last_name as last_name,
		staff.nick_name as nick_name,
		employment_status.status_desc as employment_stat,
		job_category.category_desc as job_cate,
		team.team_name as team,
		job_desc.job_name as job_desc
	from 
		staff,
		employment_status,
		job_category,
		team,
		job_desc
	where
		employment_status.status_id = staff.employment_stat
		and
		job_category.category_id = staff.job_cate
		and
		team.team_id = staff.team
		and
		job_desc.job_id = staff.job_desc
		$filter
		order by staff.staff_id");
	$stmt->execute();
	echo $stmt->rowCount() .' record/s found.';
	$content = '';
	$count = 1;
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$content .= '<tr id="data_' . $row["staff_id"] . '">';
		$content .= '<td>'. $row["staff_id"] .'</td>';
		$content .= '<td>'. $row["id_num"] .'</td>';
		$content .= '<td>'. $row["first_name"] .'</td>';
		$content .= '<td>'. $row["middle_name"] .'</td>';
		$content .= '<td>'. $row["last_name"] .'</td>';
		$content .= '<td>'. $row["nick_name"] .'</td>';
		$content .= '<td>'. $row["employment_stat"] .'</td>';
		$content .= '<td>'. $row["job_cate"] .'</td>';
		$content .= '<td>'. $row["team"] .'</td>';
		$content .= '<td>'. $row["job_desc"] .'</td>';
		$content .= '</tr>';
		$count += 1;
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th></th>
			<th>ID NO.</th>
			<th colspan="3">Full Name</th>
			<th>Nick Name</th>
			<th colspan="2">Employment Status</th>
			<th>Team Name</th>
			<th>Job Desc</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $content; ?>
	</tbody>
</table>