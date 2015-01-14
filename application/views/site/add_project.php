<div id="content" class="col-md-10 col-md-push-2 projects">
	<h2>Add Project</h2>

	<?php if(validation_errors() && $this->input->post()): ?>
    <div class="alert alert-error">
      <h4>Form Submission Errors</h3>
      <ul>
      <?php echo validation_errors('<li>','</li>'); ?>
      </ul>
    </div>
    <?php endif; ?>

		<?php echo form_open_multipart( 'admin/projects/add', array( 'id' => 'register') ); ?>
			<div class="row">


				<div class="form-group col-md-12">
					<?php echo form_label( 'Title *', 'description', array( 'class' => 'form-label' ) ); ?>
					<?php echo form_input( array('name' => 'title', 'class' => 'form-control', 'id' => 'firstname', 'value' => set_value('description') ) ); ?>
				</div>


				<div class="form-group col-md-12">
					<?php echo form_label( 'Description *', 'description', array( 'class' => 'form-label' ) ); ?>
					<?php echo form_textarea( array('name' => 'description', 'class' => 'form-control', 'id' => 'firstname', 'value' => set_value('description') ) ); ?>
				</div>

				<div class="form-group col-md-12">
					<?php echo form_label( 'Technology *', 'technology', array( 'class' => 'form-label' ) ); ?><br>
					<?php echo form_dropdown( 'technology', array( '' => '') + $tech, set_value( 'session_id' ), 'class="pretty-select" data-ajax-url="' . base_url('projects/get_by_tech') . '"' ); ?>
				</div>

				<div class="form-group col-md-12">
					<?php echo form_label( 'GitHub Link', 'github', array( 'class' => 'form-label' ) ); ?><br>
					<?php echo form_input( array('name' => 'github', 'class' => 'form-control', 'id' => 'github', 'value' => set_value('github') ) ); ?>
				</div>


				<div class="form-group col-xs-6">
					<?php echo form_label( 'Image *', 'logo', array( 'class' => 'form-label' ) ); ?>
					<?php echo form_upload( array('name' => 'picture','multiple' => '', 'class' => 'form-controll', 'id' => 'logo', 'value' => set_value( 'logo' ) ) ); ?>
				</div>

			</div>


		<button type="submit" class="btn btn-primary">Submit</button>

		<?php echo form_close(); ?>

</div>