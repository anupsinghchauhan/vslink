<!doctype html>
<html lang="en">

<!-- Header Start -->
<?php echo view('users/includes/header'); ?>
<!-- Header Start -->

<body>
  <!--============= ScrollToTop Section Starts Here =============-->
  <div id="body" class="theme-blue">
	    <!-- Page Loader -->
	    <div class="page-loader-wrapper">
	        <div class="loader">
	            <div class="mt-3"><img src="assets/images/logo/logo1.png" width="40" height="40" alt="Mooli"></div>
	            <p>Please wait...</p>        
	        </div>
	    </div>

	    <!-- Overlay For Sidebars -->
	    <div class="overlay"></div>

	    <div id="wrapper">
				<!-- Navbar Start -->
				<?php echo view('users/includes/navbar'); ?>
				<!-- Navbar End -->

				<!-- Sidebar Start -->
				<?php echo view('users/includes/sidebar'); ?>
				<!-- Sidebar End -->
		
				 <div id="main-content">
            <div class="container-fluid">
							<!-- Main Content Start -->
							<?php echo $content; ?>
							<!-- Main Content End -->
						</div>
					</div>
    	</div>
</div>
	
	<!-- Scripts Start -->
	<?php echo view('users/includes/scripts'); ?>
	<!-- Scripts End -->
</body>
</html>