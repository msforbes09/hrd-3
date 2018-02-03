<div style="width: 10%; border: 0px solid black">
	<img src="../staff_pic/<?php echo $row["image"]; ?>" style="border-radius: 50%; border: 1px solid gray; height: 150px; width: 150px;" />
</div>
<div style="position:absolute; left: 15%; top: 0;">
	<p><?php echo $name; ?></p>
	<p><?php echo $row["team_name"]; ?></p>
	<input type="button" id="master_add" class="btn btn-sm btn-danger" value="Add" />
</div>
<input id="team_value" type="hidden" value="<?php echo $row["team"]; ?>" />
<hr />