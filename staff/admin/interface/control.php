<div class="row">
	<div class="col-lg-2">
		<input type="button" id="master_add" class="btn btn-sm btn-danger" value="Add" />
	</div>
	<div class="col-lg-2">
		<select id="employment_stat_filter" class="form-control">
			<?php echo get_employment_status(); ?>
		</select>
	</div>
	<div class="col-lg-2">
		<select id="job_cate_filter" class="form-control">
			<?php echo get_job_category(); ?>
		</select>
	</div>
	<div class="col-lg-2">
		<select id="team_filter" class="form-control">
			<?php echo get_team_list(); ?>
		</select>
	</div>
	<div class="col-lg-2">
		<select id="job_desc_filter" class="form-control">
			<option value="1"></option>
		</select>
	</div>
</div>
<hr />
