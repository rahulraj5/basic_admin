</div>
		<!-- END MAIN CONTENT -->
	</div>
	<!-- END MAIN -->
	<div class="clearfix"></div>
	<footer>
		<div class="container-fluid">
			<p class="copyright">&copy; 2017 <a href="http://espsofttech.com/" target="_blank">All Rights Reserved.</a></p>
		</div>
	</footer>
</div>
<!-- END WRAPPER -->

<!-- nirbahy start -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
	<!-- Magnific Popup core JS file -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		  // Initialize popup as usual
			$('.image-link').magnificPopup({
			  type: 'image',
			  mainClass: 'mfp-with-zoom', // this class is for CSS animation below

			  zoom: {
			    enabled: true, // By default it's false, so don't forget to enable it

			    duration: 300, // duration of the effect, in milliseconds
			    easing: 'ease-in-out', // CSS transition easing function

			    // The "opener" function should return the element from which popup will be zoomed in
			    // and to which popup will be scaled down
			    // By defailt it looks for an image tag:
			    opener: function(openerElement) {
			      // openerElement is the element on which popup was initialized, in this case its <a> tag
			      // you don't need to add "opener" option if this code matches your needs, it's defailt one.
			      return openerElement.is('img') ? openerElement : openerElement.find('img');
			    }
			  }

			});
		});
	</script> 
<!-- nIrbhay End -->

<script src="<?php echo base_url(); ?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/chartist/js/chartist.min.js"></script>

<!-- DataTables js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/dataTables.bootstrap.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/responsive.bootstrap.min.js"></script>-->


<!-- Display toast message -->
<script src="<?php echo base_url(); ?>assets/vendor/toastr/toastr.min.js"></script>

<!-- for  toggle switch -->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap-toggle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

<script src="<?php echo base_url(); ?>assets/scripts/klorofil-common.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/custom.js"></script>

</body>

</html> 