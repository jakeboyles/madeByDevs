</div><!-- end .page-container -->

<!-- Delete Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<br>
				<h4 id="myModalLabel" class="semi-bold">Are you sure you want to delete this record?</h4>
				<p class="no-margin">Any data that was tied to this record may be affected. This action cannot be reversed.</p>
				<br>
			</div>

			<div class="modal-body text-center">
				<h3>Delete: <span class="data-row-label"></span></h3>
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

<!-- END CONTENT -->

<!-- BEGIN CORE JS FRAMEWORK-->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/breakpoints.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->

<!-- BEGIN PAGE LEVEL JS -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-datatable/extra/js/TableTools.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-responsive/js/datatables.responsive.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-responsive/js/lodash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/datatables.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrapv3/js/popover.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN CORE TEMPLATE JS -->
<script src="<?php echo base_url(); ?>assets/admin/js/core.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->

<!-- BEGIN CUSTOM JS -->
<script src="<?php echo base_url(); ?>assets/admin/js/custom.js" type="text/javascript"></script>
<!-- END CUSTOM JS -->

</body>
</html>