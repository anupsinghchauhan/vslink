     <!-- Page header section  -->

     <div class="card">

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

                    <div class="row clearfix">

                        <div class="col-12">

                            <div class="col-lg-12 col-12 mb-30">

                                <div class="box">

                                    <div class="box-body">

                                               <div class="section_title">
                                                    <div class="mr-3">
                                                        <h3>Contact Us</h3>
                                                    </div>
                                                    
                                                </div>
                                                <div class="card manage-link-card">
                                                    <div class="card-header">
                                                        Contact Us | Send Us Your Queries
                                                    </div>
                                                    <div class="card-body">

                                                        <?= form_open('contactquery/do_contact', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Your Name</label>
                                                                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?= $_SESSION['user_login']['Fullname']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Your Email Address</label>
                                                                        <input type="text" name="email_address" class="form-control" placeholder="Email" value="<?= $_SESSION['user_login']['Email_ID']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Your Subject</label>
                                                                        <input type="text" name="Subject" class="form-control" placeholder="Your Subject">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Your Phone Number</label>
                                                                        <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Your Message</label>
                                                                        <textarea name="msg" class="form-control" placeholder="Your Message..."> </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-2 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?= form_close(); ?>
                                                        
                                                    </div>
                                                </div>
                                               
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                        