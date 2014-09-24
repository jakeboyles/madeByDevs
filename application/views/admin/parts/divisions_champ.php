
<?php if(!empty($editing)): ?>

<div class="form-group">
	<?php echo form_label( 'Champion', 'name', array( 'class' => 'form-label' ) ); ?>
	<!-- <span class="help">e.g. </span> -->
	<?php echo form_dropdown( 'winner_id', array( '' => '') + $teams, set_value( 'winner_id',$editing[0]['team_id'] ), 'class="pretty-select"' ); ?>
</div>


<div class="form-group row">
	<div class="col-xs-8">
		<?php echo form_label( 'Champion Image', 'name', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<?php echo form_upload( array('name' => 'upload', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'upload') ) ); ?>
	</div>
	<div class="col-xs-4">
		<?php if(!empty($editing[0]['picture'])): ?>
		<img class="division-edit-picture" src="<?php echo base_url('uploads')."/".$editing[0]['picture']; ?>" />
		<?php endif; ?>
	</div>
</div>

<div class="form-group">
	<?php echo form_label( 'Headline', 'name', array( 'class' => 'form-label' ) ); ?>
	<!-- <span class="help">e.g. </span> -->
	<?php echo form_input( array('name' => 'headline', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name',$editing[0]['headline'] ) ) ); ?>
</div>

<div class="form-group row">
	<div class="col-xs-8">
		<?php echo form_label( 'Headline Image', 'name', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<?php echo form_upload( array('name' => 'headline_image', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name') ) ); ?>
	</div>
	<div class="col-xs-4">
		<?php if(!empty($editing[0]['headline_image'])): ?>
		<img class="division-edit-picture" src="<?php echo base_url('uploads')."/".$editing[0]['headline_image']; ?>" />
		<?php endif; ?>
	</div>
</div>


<?php echo form_hidden( 'updating','true' ); ?>

<?php echo form_hidden( 'media_id',$editing[0]['media_id'] ); ?>

<?php echo form_hidden( 'headline_id',$editing[0]['headline_id'] ); ?>

<?php echo form_hidden( 'season_id',$season ); ?>


<?php else: ?>

<div class="form-group">
	<?php echo form_label( 'Champion *', 'name', array( 'class' => 'form-label' ) ); ?>
	<!-- <span class="help">e.g. </span> -->
	<?php echo form_dropdown( 'winner_id', array( '' => '') + $teams, set_value( 'winner_id' ), 'class="pretty-select"' ); ?>
</div>

<div class="form-group">
	<?php echo form_label( 'Champion Image *', 'name', array( 'class' => 'form-label' ) ); ?>
	<!-- <span class="help">e.g. </span> -->
	<?php echo form_upload( array('name' => 'upload', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'upload' ) ) ); ?>
</div>

<div class="form-group">
	<?php echo form_label( 'Headline *', 'name', array( 'class' => 'form-label' ) ); ?>
	<!-- <span class="help">e.g. </span> -->
	<?php echo form_input( array('name' => 'headline', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name' ) ) ); ?>
</div>

<div class="form-group">
	<?php echo form_label( 'Headline Image *', 'name', array( 'class' => 'form-label' ) ); ?>
	<!-- <span class="help">e.g. </span> -->
	<?php echo form_upload( array('name' => 'headline_image', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name') ) ); ?>
</div>

<?php echo form_hidden( 'season_id',$season ); ?>

<?php echo form_hidden( 'updating', 'false' ); ?>

<?php endif; ?>

