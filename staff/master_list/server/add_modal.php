<?php
require_once 'function.php';
?>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">I.D. Number: </h5>
	</div>
	<div class="col-lg-8">
		<input id="id_num_txt" type="text" class="form-control default" placeholder="type id number here..." maxlength="7" />
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">First Name: </h5>
	</div>
	<div class="col-lg-8">
		<input id="first_name_txt" type="text" class="form-control" placeholder="type first name here..." maxlength="20"  />
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Middle Name: </h5>
	</div>
	<div class="col-lg-8">
		<input id="middle_name_txt" type="text" class="form-control" placeholder="type middle name here..." maxlength="20"  />
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Last Name: </h5>
	</div>
	<div class="col-lg-8">
		<input id="last_name_txt" type="text" class="form-control" placeholder="type last name here..." maxlength="20"  />
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Nick Name: </h5>
	</div>
	<div class="col-lg-8">
		<input id="nick_name_txt" type="text" class="form-control" placeholder="type nick name here..." maxlength="10"  />
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Employment Status: </h5>
	</div>
	<div class="col-lg-8">
		<select id="employment_stat_select" class="form-control">
			<?php echo get_employment_status(); ?>
		</select>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Job Position: </h5>
	</div>
	<div class="col-lg-8">
		<select id="job_cate_select" class="form-control">
			<?php echo get_job_category(); ?>
		</select>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Team Name: </h5>
	</div>
	<div class="col-lg-8">
	<?php if($_REQUEST["team_filter"] == 1){ ?>
		<select id="team_select" class="form-control">
			<?php echo get_team_list(); ?>
		</select>
	<?php } else { ?>
		<input type="text" class="form-control" value="<?php echo get_team_name($_REQUEST["team_filter"]); ?>" readonly />
		<input id="team_select" type="hidden" value="<?php echo $_REQUEST["team_filter"]; ?>" />
	<?php } ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Job Description: </h5>
	</div>
	<div class="col-lg-8">
		<select id="job_desc_select" class="form-control">
			<?php echo get_job_desc($_REQUEST["team_filter"]); ?>
		</select>
	</div>
</div>
<div id="err_prompt" style="color: red; text-align: center; margin-top: 10px; font-size:1.5em;"></div>