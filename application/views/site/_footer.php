			</div><!-- end .row -->
		</div><!-- end .container -->

		<!-- Delete Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<br>
				<h5 id="myModalLabel" class="semi-bold">Are you sure you want to delete this record?</h5>
				<p class="no-margin">Any data that was tied to this record may be affected. This action cannot be reversed.</p>
				<br>
			</div>

			<div class="modal-body text-center">
				<h5>Delete: <span class="data-row-label"></span></h5>
			</div>

			<div class="modal-footer">
				<div class="alert alert-error text-center hide">
					This record cannot be deleted as there is data that is attached to it.
				</div>

				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" data-action="delete-row" data-id="">Delete Record</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>



		<footer>
			<div class="container">
				<div class="row">
					<div class="col-xs-6 logo">
						<a href="<?php echo base_url(); ?>">Gotham Soccer League</a>
					</div>
					<div class="col-xs-6 social">
						<ul>
							<li><a href="#" class="social"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="social"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="social"><i class="fa fa-youtube"></i></a></li>
						</ul>
					</div>
				</div>
				<ul class="row footer-links">
					<li class="col-xs-6 col-md-3"><a href="#">2 Divisions<i class="fa fa-chevron-right"></i></a></li>
					<li class="col-xs-6 col-md-3"><a href="#">History<i class="fa fa-chevron-right"></i></a></li>
					<li class="col-xs-6 col-md-3"><a href="#">Field Directions<i class="fa fa-chevron-right"></i></a></li>
					<li class="col-xs-6 col-md-3"><a href="#">Team Pages<i class="fa fa-chevron-right"></i></a></li>
				</ul>
			</div>
		</footer>
		<div id="main-footer">
			<div class="container">
				<div class="row">
					<p>Gotham Soccer League | <a href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></p>
				</div>
			</div>
		</div>

		<!-- Footer JS Files -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?php echo base_url('assets/site/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
		<script src="<?php echo base_url('assets/site/assets/js/scripts.min.js'); ?>"></script>
		
	</body>

</html>