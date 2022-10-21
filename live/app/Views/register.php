<!doctype html>

<html class="no-js" lang="">



<?php echo view('includes/login-header'); ?>



<body>


    <div id="preloader" class="preloader">

        <div class='inner'>

            <div class='line1'></div>

            <div class='line2'></div>

            <div class='line3'></div>

        </div>

    </div>

    <section class="fxt-template-animation fxt-template-layout33">

        <div class="fxt-content-wrap">

            <div class="fxt-heading-content login-heading">

                <div class="fxt-inner-wrap fxt-transformX-R-50 fxt-transition-delay-3 login-form signup-form">

                        <div class="row login-form-row">

                            <div class="col-lg-5">

                                <div class="fxt-middle-content form-left">

                                    <a href="<?= base_url('/');?>">

                                        <img src="<?= base_url('assets/images/logo/logo-white.png');?>" alt="logo">

                                    </a>

                                </div>

                            </div>

                            <div class="col-lg-7">

                                <div class="fxt-main-form form-right">

                                    <div class="row need-help-row">

                                        <a href="<?php echo base_url('help');?>" class="need-help-text"> Need Help?</a>

                                    </div>

                                <div class="fxt-opacity fxt-transition-delay-13">

                                  <?php if($session->has('success')){ ?>

                                            <div class="alert alert-success alert-dismissible show">

                                                <div class="alert-body">

                                                    <button class="close" data-dismiss="alert">

                                                        <span>&times;</span>

                                                    </button>

                                                    <?= $session->getFlashdata('success'); ?>

                                                </div>

                                            </div>

                                        <?php }elseif ($session->has('error')) { ?>

                                            <div class="alert alert-danger alert-dismissible show">

                                                <div class="alert-body">

                                                    <button class="close" data-dismiss="alert">

                                                        <span>&times;</span>

                                                    </button>

                                                    <?= $session->getFlashdata('error'); ?>

                                                </div>

                                            </div>

                                        <?php } ?>

                                  <!-- <div class="fxt-transformX-R-50 fxt-transition-delay-10 form-logo">

                                    <a href="login-33.html" class="fxt-logo"><img src="<?= base_url('assets/img/gallery/logoo.png');?>" alt="Logo"></a>

                                  </div> -->

                                <h4 class="fxt-page-title text-center"><strong>Sign Up</strong></h4>

                               <?= form_open('auth/do_register', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>

                                    <div class="form-group">

                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" required="required">

                                        <span class="focus-input3"></span>

                                    </div>

                                    <div class="form-group">

                                        <input type="email" id="email" class="form-control" name="emailid" placeholder="Email" required="required">

                                        <span class="focus-input3"></span>

                                    </div>
                                    <div class="form-group">

                                        <input id="referal" type="text" class="form-control" name="referal" placeholder="Enter 8 Digit Referral Code" required="required" value="<?php if(isset($referralcode)) { echo $referralcode; }else { echo ''; }?>">
                                        

                                    </div>

                                    <div class="form-group">

                                        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required="required">

                                    </div>

                                    <div class="form-group agreement">

                                        <div>

                                          <input type="checkbox" id="horns" name="agreement" class="agreement-check">

                                          <label for="horns">I AGREE TO <a href="<?php echo base_url('terms-conditions');?>" target="_blank">TERMS OF USE</a> & <a href="<?php echo base_url('privacy-policy');?>" target="_blank">PRIVACY POLICY</a></label>

                                        </div>

                                    </div>

                                    

                                    <div class="form-group">

                                        <button type="submit" class="fxt-btn-fill">Register</button>

                                    </div>

                                    <div class="form-group mb-3">

                                        <a href="<?= base_url('/login');?>" class="fxt-btn-bordered">Sign In</a>

                                    </div>

                                    <!--<div class="form-group auth-with-social">-->

                                    <!--    <h6>Sign Up With </h6> -->

                                    <!--    <div class="social-buttons"> <a href=""><i class="fa fa-facebook"></i></a><a href=""> <i class="fa fa-google"></i> </a><a href=""><i class="fa fa-twitter"></i></a>   </div>-->

                                    <!--</div>-->

                                 <?= form_close(); ?>

                                

                                

                            </div>

                        </div>

                    </div>



                </div>

                   

                </div>

            </div>

            <div class="fxt-form-content">

            </div>

        </div>

    </section>

    <?php echo view('includes/login-footer'); ?>



</body>

</html>



