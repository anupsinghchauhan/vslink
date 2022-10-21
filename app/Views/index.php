

    <!--============= Banner Section Starts Here =============-->

    <section class="banner-section">

        <div class="banner-bg bg_img" data-background="<?= base_url('assets/images/banner/banner.png');?>">

            

        </div>

        <div class="container">

            <div class="banner-content">

                <h1 class="cate">Shorten URLs   </h1>

                <h4 class="title">Earn Money</h4>

            </div>

            <div class="banner-form-group">

                <?= form_open('shortenalgorithm/do_generate', ['class' => 'banner-form needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>

                <div class="input-group mb-3">

                  <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Enter the link here" name="url" required>

                  <div class="input-group-append">

                    <button class="btn btn-outline-secondary" type="submit">Shorten Link</button>

                  </div>

                </div>

                      

                <?= form_close(); ?>

                

            </div>

        </div>

    </section>

    <!--============= Banner Section Ends Here =============-->



    <!--============= How Section Starts Here =============-->

    <section class="how-section padding-top padding-bottom pt-md-half">

        <div class="container">

            <div class="section-header mb-low">

                <h3 class="title mt-md-0">Monetize Your Website and Links You Share</h3>

                <p class="sec-twop">

                    Smart & Easy Way to get extra income from Your Traffic.

                </p>

                

            </div>

            <div class="row justify-content-center mb--40">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                    <div class="how-item">

                        <div class="how-thumb">

                            <img src="<?= base_url('assets/images/how/createacc.png');?>" alt="how">

                        </div>

                        <div class="how-content">

                            <h6 class="title">Create Acount</h6>

                        </div>

                    </div>

                </div>

                <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">

                    <div class="">

                        <div class="classArrow">

                            <span class="right-process">&#x2b;</span>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                    <div class="how-item">

                        <div class="how-thumb">

                            <img src="<?= base_url('assets/images/how/shortlink.png');?>" alt="how">

                        </div>

                        <div class="how-content">

                            <h6 class="title">Shorten Link</h6>

                        </div>

                    </div>

                </div>

                <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">

                    <div class="">

                        <div class="classArrow">

                            <span class="right-process">&#x3d;</span>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                    <div class="how-item">

                        <div class="how-thumb">

                            <img src="<?= base_url('assets/images/how/earnmoney.png');?>" alt="how">

                        </div>

                        <div class="how-content">

                            <h6 class="title">Earn Money</h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!--============= How Section Ends Here =============-->



     <!--============= Feature Section Starts Here =============-->

    <section class="feature-section padding-top oh padding-bottom pb-lg-half bg_img pos-rel" style="background: #39a6e7;">

        

        

        <div class="container">

            <div class="section-header cl-white">

                <!-- <h5 class="cate">Choose a plan that's right for you</h5> -->

                <h2 class="title mt-md-0 user-earn">User Who Can Earn</h2>

            </div>

            <div class="tab">

                <ul class="tab-menu feature-tab">

                    <div class="row">

                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">

                            <li>

                                <div class="earn-head">Website & Blog Owners</div>

                                <p class="earn-desc">Who earn extra money on outgoing and internal links on their sites.</p>

                            </li>

                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">

                            <li>

                                <div class="earn-head">Social Media & Community Members</div>

                                <p class="earn-desc">Using vslinq.com links in their posts, comments and messages.</p>

                            </li>

                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">

                            <li>

                                <div class="earn-head"> Online Marketers & Affiliates</div>

                                <p class="earn-desc">Who show others how to make money and benefit from vslinq.com </p>

                            </li>

                        </div>  

                    </div>

                </ul>

                

            </div>

            <div class="row join-now-row">

                <div class="mb-30">

                    <a class="join-now" href="<?= base_url('/login');?>">Login Now <br/> <p class="join-now-subtext">and start earning</p></a>

                </div>

                <div>

                    <a class="join-now" href="<?= base_url('/register');?>">Register Now <br/> <p class="join-now-subtext">and start earning</p></a>

                </div>

            </div>

        </div>

    </section>

    <!--============= Feature Section Ends Here =============-->





    <!--============= Testimonial Section Starts Here =============-->

    <section class="testimonial-section padding-top padding-bottom pos-rel oh">

        

        <div class="container">

                <div class="banner-form-group">

                <h3 class="subtitle">Numbers Speak!</h3>

                

                <div class="banner-counter">

                    <div class="counter-item">

                        <div class="thumb number">

                            <img src="<?= base_url('assets/images/numbers/clicks.png');?>" alt="feature">

                        </div>

                        <h2 class="counter-title"><span class="counter"> <?= $views_count; ?></span>+</h2>

                        <p>Total Clicks</p>

                    </div>

                    <div class="counter-item">

                        <div class="thumb number">

                            <img src="<?= base_url('assets/images/numbers/links.png');?>" alt="feature">

                        </div>

                        <h2 class="counter-title"><span class="counter"><?= $TShortlinks_count; ?></span>+</h2>

                        <p>Shortened links in total</p>

                    </div>

                    <div class="counter-item">

                        <div class="thumb number">

                            <img src="<?= base_url('assets/images/numbers/users.png');?>" alt="feature">

                        </div>

                        <h2 class="counter-title"><span class="counter"><?= $Tusers_count; ?></span>+</h2>

                        <p>Happy users registered</p>

                    </div>

                    <a href="#getintouch"><div class="counter-item">

                        <div class="thumb number">

                            <img src="<?= base_url('assets/images/numbers/contact.png');?>" alt="feature">

                        </div>

                        <h2 class="counter-title text-white"><span class="counter">0</span>+</h2>

                        <p>Contact Us</p>

                    </div></a>

                </div>

            </div>

        </div>

    </section>

    <!--============= Testimonial Section Ends Here =============-->



    <!--============= Call In Action Section Starts Here =============-->

    <section class="call-in-action padding-top section-last text-center " id="getintouch">

        <div class="container">

            <div class="section-header">

                <h2 class="title sec-last-title">Get in touch with us</h2>

            </div>

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

            <?= form_open('contactquery/do_send_query', ['class' => 'get-in-touch-form needs-validation', 'novalidate' => '', 'autocomplete' => 'off','id'=>'']); ?>

                <div class="row">

                    <div class="col-lg-4 col-md-12 col-sm-12">

                        <div class="form-group">

                            <input type="text" name="name" id="name" placeholder="Enter Your Full Name*">

                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">

                        <div class="form-group">

                            <input type="text" name="emailid" id="email" placeholder="Enter Your Email*">

                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">

                        <div class="form-group">

                            <input type="text" name="subject" id="subject" placeholder="Enter Your Subject*">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="form-group">    

                            <textarea name="message" id="message" placeholder="Enter Your Message" cols="10"></textarea>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="form-group check-group">

                            <input type="checkbox" id="check" class="check-box" name="consent" required>

                            <label for="check" class="agreement-text">I consent to having this website store my submitted information so they can respond to my inquiry.</label>

                        </div>

                    </div>

                </div>

                <div class="row subit-getin-touch">

                    <div class="form-group text-center">

                        <button type="submit" class="get-in-touch-btn">Submit</button>

                    </div>

                </div>

            <?= form_close(); ?>

        </div>

    </section>

    <!--============= Call In Action Section Ends Here =============-->



    <!--============= Join Us Section Starts Here =============-->

        <!-- <section class="call-in-action  padding-bottom section-bg text-center">

            <div class="container">

                <div class="section-header mb-low">

                            <h5 class="cate">JOIN WITH US</h5>

                            <p>Sign up for free and become one of the millions of people around the world

                                who have fallen in love with VSLINQ</p>

                        </div>

                        <a href="<?= base_url('/login');?>" class="custom-button margin-right">LOGIN</a>

                        <a href="<?= base_url('/register');?>" class="custom-button">REGISTER</a>

            </div>

        </section> -->

    <!--============= Join Us Section Ends Here =============-->