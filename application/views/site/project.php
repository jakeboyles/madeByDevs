<div class="content col-md-10 singleProject">


		<?php 
			$pics = $project['project']['pictures'];
			$pics = json_decode($pics);
			$main = '';
			if(is_array($pics)) {
				foreach($pics as $pic)
				{
					$main  =  $pic->image;
				}
			}
			?> 
			
		<div class="col-md-12">
			<div class="projectContainer">

				<div class="col-md-12">
					<h2><?php echo $project['project']['title']; ?></h2>
				</div>

				<div class="col-md-4">
					<a class="author" href="<?php echo base_url('users/profile').'/'.$project['project']['author_id']; ?>"><p><i class="fa fa-user"></i>  <?php echo $project['project']['name']; ?></p></a>
				</div>

				<div class="col-md-4">
						<P><i class="fa fa-calendar"></i> <span><?php echo date("m/d/y",strtotime($project['project']['date_posted'])); ?></span></P>
				</div>

				<div class="col-md-4">
						<P><i class="fa fa-anchor"></i> <?php echo $project['project']['github'] ?></P>
				</div>

				<div class="col-md-12">

					<a href="<?php echo base_url('projects/view').'/'.$project['project']['id']; ?>">
						<img class="" src="<?php echo base_url('uploads').'/'.$main ?>">
					</a>

				</div>

				<p class="contentText"><?php echo $project['project']['description']; ?></p>

				<?php if($this->session->userdata('user_type_id')==2 || $this->session->userdata('user_type_id')==1): ?>
				<div class="col-md-12 question">
					<P class="m-t-30 addQuestion">Have a question on this project? <a data-toggle="modal" data-target=".questionModal" href="">Ask the author!</a></P>
					<P class="m-t-30">You can also <a data-toggle="modal" data-target=".commentModal" href="">comment on the project!</a></P>
				</div>
				<?php endif; ?>

			</div>
		</div>



		<div class="col-md-6 commentSection">

			<h2>Comments</h2>

			<?php if(!empty($comments)): ?>
			<?php foreach($comments as $comment): ?>
				<div class="comment row">
					<div class="col-md-2">
						<?php echo profile_image($comment['profile_pic']); ?>
					</div>

					<div class="col-md-10">
						<h3><?php echo $comment['display_name']; ?></h3>
						<p><?php echo $comment['comment']; ?></p>

						<span><i data-tech="<?php echo $project['project']['techid']; ?>" data-user="<?php echo $comment['user_id']; ?>" data-id='<?php echo $comment['id']; ?>' class="fa fa-thumbs-up"></i></span>
						<span  class="p-l-15"><i data-tech="<?php echo $project['project']['techid']; ?>" data-user="<?php echo $comment['user_id']; ?>" data-id='<?php echo $comment['id']; ?>' class="fa fa-thumbs-down"></i></span>
						 <span data-votes="<?php echo $comment['votes']; ?>" class="numVotes p-l-15"><?php echo $comment['votes']; ?></span> Votes
	 				</div>
				</div>
			<?php endforeach; ?>
			<?php else: ?>
				<P>There are no comments right now, how about adding one?</P>
			<?php endif;?>
		</div>


		<div class="col-md-6">

			<h2>Questions</h2>

			<?php if(!empty($questions)): ?>
			<?php foreach($questions as $question): ?>
				<div class="questionInfo row">
					<div class="col-md-2">
 						<?php echo profile_image($question['profile_pic']); ?>
 					</div>

					<div id="questions" class="col-md-10">
						<h3>Question:</h3>
						<p><?php echo $question['question']; ?></p>
						<?php if(!empty($question['answer'])): ?>
						<h3>Answer:</h3>
						<p><?php echo $question['answer']; ?></p>
						<?php endif; ?>

						<?php if(($this->session->userdata('user_id')===$project['project']['author_id'] ) && $question['status']==0) :?>
							<form id="commentForm" enctype="multipart/form-data">
									<?php echo form_label( 'Answer *', 'comment', array( 'class' => 'form-label' ) ); ?>
									<?php echo form_textarea( array('name' => 'comment', 'class' => 'form-control', 'id' => 'theQuestion', 'value' => set_value('description') ) ); ?>
									<button type="button" id="answerQuestion" data-id="<?php echo $project['project']['id']; ?>" data-ajax-url="<?php echo base_url() ?>questions/answerQuestion/<?php echo $question['id']; ?>" class="m-t-20 btn btn-primary">Answer It</button>
							</form>
						<?php endif; ?>
	 				</div>
				</div>
			<?php endforeach; ?>
			<?php else: ?>
				<P>There are no questions right now.</P>
			<?php endif;?>
		</div>

</div>



<div class="modal questionModal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ask a question...</h4>
      </div>
      <div class="modal-body clearfix">
        <form id="askQuestion" enctype="multipart/form-data">
        	<div class="form-group col-md-12">
				<?php echo form_label( 'Question *', 'description', array( 'class' => 'form-label' ) ); ?>
				<?php echo form_textarea( array('name' => 'question', 'class' => 'form-control', 'id' => 'theQuestion', 'value' => set_value('description') ) ); ?>
			</div>

			<div class="form-group col-xs-6">
				<?php echo form_label( 'Want to show an image? *', 'logo', array( 'class' => 'form-label' ) ); ?>
				<?php echo form_upload( array('name' => 'picture','multiple' => '', 'class' => 'form-controll', 'id' => 'logo', 'value' => set_value( 'logo' ) ) ); ?>
			</div>
			<input type="hidden" name="author" value="<?php echo $project['project']['author_id']; ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="addQuestion" data-ajax-url="<?php echo base_url() ?>questions/addQuestion/<?php echo $project['project']['id']; ?>" class="btn btn-primary">Ask It</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<div class="modal commentModal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Leave A Comment...</h4>
      </div>
      <div class="modal-body clearfix">
        <form id="commentForm" enctype="multipart/form-data">
        	<div class="form-group col-md-12">
				<?php echo form_label( 'Comment *', 'comment', array( 'class' => 'form-label' ) ); ?>
				<?php echo form_textarea( array('name' => 'comment', 'class' => 'form-control', 'id' => 'theQuestion', 'value' => set_value('description') ) ); ?>
			</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="leaveComment" data-ajax-url="<?php echo base_url() ?>admin/projects/addComment/<?php echo $project['project']['id']; ?>" class="btn btn-primary">Comment</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




