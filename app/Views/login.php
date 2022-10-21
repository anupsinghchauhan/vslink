<!doctype html>

<html class="no-js" lang="">



<?php echo view('includes/login-header'); ?>



<body>

    <!--[if lt IE 8]>

        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>

    <![endif]-->

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

                <div class="fxt-inner-wrap fxt-transformX-R-50 fxt-transition-delay-3 login-form">

                        <div class="row login-form-row">

                            <div class="col-lg-5 col-md-12 col-sm-12">

                                <div class="fxt-middle-content form-left">

                                    <a href="<?= base_url('/');?>">

                                        <img src="<?= base_url('assets/images/logo/logo-white.png');?>" alt="logo">

                                    </a>

                                </div>

                            </div>

                            <div class="col-lg-7 col-md-12 col-sm-12">

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

                                <h4 class="fxt-page-title text-center"><strong>Log In</strong></h4>

                               <?= form_open('auth/do_login', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>

                                    <div class="form-group">

                                        <input type="email" id="email" class="form-control" name="emailid" placeholder="Username" required="required">

                                        <span class="focus-input3"></span>

                                    </div>

                                    <div class="form-group">

                                        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required="required">

                                    </div>

                                    <div class="form-group forget-password">

                                        <a href="<?= base_url('/forgot-password');?>" class="fxt-switcher-text">Forgot Password ?</a>

                                    </div>

                                    <!--<div class="form-group google-captcha">-->

                                    <!--    <img src="<?= base_url('assets/images/google captcha.png');?>" alt="logo">-->

                                    <!--</div>-->

                                    <div class="form-group">

                                        <button type="submit" class="fxt-btn-fill">Log In</button>

                                    </div>

                                    <div class="form-group mb-3">

                                        <a href="<?= base_url('/register');?>" class="fxt-btn-bordered">Sign Up</a>

                                    </div>

                                    <!--<div class="row">-->

                                    <!--    <div class="form-group auth-with-social">-->

                                    <!--        <h6>Sign in With </h6> -->

                                    <!--        <div class="social-buttons"> <a href=""><i class="fa fa-facebook"></i></a><a href=""> <i class="fa fa-google"></i> </a><a href=""><i class="fa fa-twitter"></i></a>   </div>-->

                                    <!--    </div>-->

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



