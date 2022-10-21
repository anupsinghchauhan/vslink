<!doctype html>
<html class="no-js" lang="">

<?php echo view('includes/header'); ?>

<body>
    <section class="padding-top-2 padding-bottom-2">
            <div class="row step3-logo-row">
                <a href="<?= base_url('/');?>">
                    <img src="<?= base_url('assets/images/logo/logo.png');?>" alt="logo">
                </a>
            </div>
            <div class="row">
                <div class="col-lg-2 col-sm-12 col-md-12"></div>
                <div class="col-lg-8 col-sm-12 col-md-12">
                    <a href="" class="ad-link margin-bottom"><img src="<?= base_url('assets/images/ads/adbanner.png');?>" class="ad-img"></a>
                </div>
                <div class="col-lg-2 col-sm-12 col-md-12"></div>
            </div>   
            <div class="row"> 
                <div class="col-lg-2 col-sm-12 col-md-12"></div>
                <div class="col-lg-8 col-sm-12 col-md-12">    
                    <div class="section-header">
                        <h5 class="title">Thank You For Visit!
                            you will be redirect to your link soon (domain.com) 
                        </h5>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12 col-md-12"></div>
            </div>
            <div class="row">
                <div class="col-lg-5"></div>
                <div class="col-lg-2 col-sm-12 col-md-12">

                    <div class="timer-box">
                        <div class="time-second"><h5>5</h5></div>
                        
                    </div>
                </div>
                <div class="col-lg-5"></div>
            </div>
            <div class="row">   
                <div class="col-lg-4 col-sm-12 col-md-12"></div>
                <div class="col-lg-4 col-sm-12 col-md-12">
                    <a href="" class="ad-link margin-top margin-bottom"><img src="<?= base_url('assets/images/ads/admid.png');?>" class="ad-img"></a>
                </div>
                <div class="col-lg-4 col-sm-12 col-md-12"></div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12 col-md-12"></div>
                <div class="col-lg-4 col-sm-12 col-md-12">
                    
                    <div class="get-link" id="get_link" style="display: none;">
                        <a href="javascript:;" id="<?= $link_data->link_id; ?>" class="get_link">Get Link</a>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 col-md-12"></div>
            </div>
            <div class="row">   
                <div class="col-lg-2 col-sm-12 col-md-12"></div>
                <div class="col-lg-8 col-sm-12 col-md-12">
                    <a href="" class="ad-link margin-top"><img src="<?= base_url('assets/images/ads/adbanner2.png');?>" class="ad-img"></a>
                </div>
                <div class="col-lg-2 col-sm-12 col-md-12"></div>
            </div>
    </section>
    <?php echo view('includes/scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 5;
            var interval = setInterval(function() {
                counter--;
                $('.time-second h5').text(counter);
                // Display 'counter' wherever you want to display it.
                if (counter == 0) {
                    // Display a login box
                    clearInterval(interval);
                     // CSRF Hash

                    var csrfName = $('.txt_csrfname').attr('name');

                    var csrfHash = $('.txt_csrfname').val();
                    var link_id = $('.get_link').attr('id');
                    $.ajax({

                      url: BASE_URL + '/AjaxController/get_link',

                      type: 'post',

                      data: { link_id: link_id, [csrfName]: csrfHash },

                      dataType: 'json',

                      success: function(result) {

                          if (result.response == true) {

                              $(".status-updated").text(result.message);

                              $(".alert2-success").show();

                              $('.loadingDiv').hide();

                              window.location.href = result.url;


                          } else {

                              $(".status-error").text(result.message);

                              $(".alert2-danger").show();

                              $('.loadingDiv').hide();

                              window.location.href = result.url;
                          }

                          $('input[name="csrf_test_name"]').val(result.token);

                          $('.txt_csrfname').val(result.token);

                      }

                  });
                }
            }, 1000);
        });
    </script>
</body>
</html>

   