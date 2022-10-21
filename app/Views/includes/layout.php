<!DOCTYPE html>
<html lang="en">

<!-- Header Start -->
<?php echo view('includes/header'); ?>
<!-- Header Start -->

<body>
  <!--============= ScrollToTop Section Starts Here =============-->
    <div class="overlayer" id="overlayer">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>
    <a href="#0" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
    <div class="overlay"></div>
   <!--============= ScrollToTop Section Ends Here =============-->
		<!-- Navbar Start -->
		<?php echo view('includes/navbar'); ?>
		<!-- Navbar End -->

		

		<!-- Main Content Start -->
		<?php echo $content; ?>
		<!-- Main Content End -->
    
	<!-- Footer Start -->
	<?php //echo view('includes/footer'); ?>

      <!-- /#wrapper -->
      <!-- Scroll to Top Button-->
      <!-- <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a> -->
      
	<!-- Footer End -->
	<?php echo view('includes/common'); ?>
	<!-- Scripts Start -->
	<?php echo view('includes/scripts'); ?>
	<!-- Scripts End -->
</body>
</html>