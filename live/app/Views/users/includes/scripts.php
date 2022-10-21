<!-- Javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?= base_url('userassets/bundles/libscripts.bundle.js');?>"></script>
<script src="<?= base_url('userassets/bundles/vendorscripts.bundle.js');?>"></script>
<script>
	var BASE_URL = '<?= base_url('/'); ?>';
</script>

<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
<script type="text/javascript">
	
	function copyToClipboard(element) {
	 var $temp = $("<input>");
	 $("body").append($temp);
	 $temp.val($(element).html()).select();
	 document.execCommand("copy");
	 $temp.remove();
	 // Get the snackbar DIV
	  var x = document.getElementById("snackbar");

	  // Add the "show" class to DIV
	  x.className = "show";

	  // After 3 seconds, remove the show class from DIV
	  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}
	function copyreferToClipboard(element1) {

	 var $temp1 = $("<input>");
	 $("body").append($temp1);
	 $temp1.val($(element1).html()).select();
	 document.execCommand("copy");
	 $temp1.remove();
	 // Get the snackbar DIV
	  var x1 = document.getElementById("refersnackbar");

	  // Add the "show" class to DIV
	  x1.className = "show";
	  $('.referral_linktext').show();
	  // alert(x1.className);
	  // After 3 seconds, remove the show class from DIV
	  setTimeout(function(){ x1.className = x1.className.replace("show", ""); }, 3000);
	}
	function copyreferpageToClipboard(element3) {

	 var $temp3 = $("<input>");
	 $("body").append($temp3);
	 $temp3.val($(element3).html()).select();
	 document.execCommand("copy");
	 $temp3.remove();
	 // Get the snackbar DIV
	  var x3 = document.getElementById("referpagesnackbar");

	  // Add the "show" class to DIV
	  x3.className = "show";
	  $('.referral_linktext').show();
	  // alert(x1.className);
	  // After 3 seconds, remove the show class from DIV
	  setTimeout(function(){ x3.className = x3.className.replace("show", ""); }, 3000);
	}

	function copymainToClipboard(element2) {
	 var $temp2 = $("<input>");
	 $("body").append($temp2);
	 $temp2.val($(element2).html()).select();
	 document.execCommand("copy");
	 $temp2.remove();
	 // Get the snackbar DIV
	  var x2 = document.getElementById("snackbarindex");

	  // Add the "show" class to DIV
	  x2.className = "show";

	  // After 3 seconds, remove the show class from DIV
	  setTimeout(function(){ x2.className = x2.className.replace("show", ""); }, 3000);
	}

	//Password Eye Query

	$("body").on('click', '.toggle-password', function() {
	  $(this).toggleClass("fa fa-eye fa fa-eye-slash");
	  var input = $("#pass_log_id");
	  if (input.attr("type") === "password") {
	    input.attr("type", "text");
	  } else {
	    input.attr("type", "password");
	  }

	});

</script>


<!-- Vedor js file and create bundle with grunt  --> 
<script src="<?= base_url('userassets/bundles/flotscripts.bundle.js');?>"></script><!-- flot charts Plugin Js -->
<script src="<?= base_url('userassets/bundles/c3.bundle.js');?>"></script>
<script src="<?= base_url('userassets/bundles/apexcharts.bundle.js');?>"></script>
<script src="<?= base_url('userassets/bundles/jvectormap.bundle.js');?>"></script>
<script src="<?= base_url('userassets/vendor/toastr/toastr.js');?>"></script>

<!-- Data tables -->
    <script src="<?= base_url('userassets/plugins/datatable/jquery.dataTables.min.js');?>"></script>
    <script src="<?= base_url('userassets/plugins/datatable/dataTables.bootstrap4.min.js');?>"></script>
    <script src="<?= base_url('userassets/js/datatable.js');?>"></script>
    <script src="<?= base_url('userassets/plugins/datatable/datatable.js');?>"></script>


<!-- Project core js file minify with grunt --> 
<script src="<?= base_url('userassets/bundles/mainscripts.bundle.js');?>"></script>
<script src="<?= base_url('userassets/js/index.js');?>"></script>

