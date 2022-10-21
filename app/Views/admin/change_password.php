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
                                                <div class="m-t-35"></div>
                                                <div class="card manage-link-card">
                                                    <div class="card-header">
                                                        Update Profile Details
                                                    </div>
                                                    <div class="card-body">
                                                        <?= form_open('admin/do_change_password', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        (See Password) &nbsp;<i class="fa fa-eye field_icon toggle-password"></i>
                                                                        <input id="pass_log_id" type="password" name="current_pass" class="form-control" placeholder="Current Password" value="<?=  view_cell('\App\Controllers\User::getcurrent_password', 'user_id='.$_SESSION['user_login']['user_id']);  ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="password" name="new_pass" class="form-control" placeholder="New Password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="password" name="confirm_new_pass" class="form-control" placeholder="Re-enter New Password">
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