<div class="content col-md-10 allProjects">

<div class="col-md-12 p-b-30">
		<h2>All Projects</h2>

		<label class='p-r-20'>Filter By Technology</label>
		<?php echo form_dropdown( 'techs', array( '' => '') + $tech, set_value( 'session_id' ), 'class="pretty-select chooseTech" data-ajax-url="' . base_url('projects/get_by_tech') . '"' ); ?>
		<a href="<?php echo base_url('admin/projects/add'); ?>" class="pull-right btn btn-primary">Add Project</a>
</div>


	<div class='projects'>
	<?php $this->load->view('site/all_projects'); ?>
	</div>
</div>


