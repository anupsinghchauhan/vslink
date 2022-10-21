 <!-- The actual snackbar -->

<div id="snackbarindex">Copied Successfully!</div>

<!-- Page header section  -->

                <div class="block-header">

                    <div class="row clearfix">

                        

                    </div>

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

                <div class="row clearfix">

                    <div class="col-12">

                        <div class="card">

                            <?= form_open('shortenalgorithm/generate_link', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>

                                <div class="body url-form-body">

                                    <div class="row clearfix">

                                        <div class="col-sm-12 col-lg-12">

                                            <div class="form-group c_form_group">

                                                <?php if(!empty($_SESSION['user_login']['main_templink'])){ ?>

                                                    <input class="form-control" type="text" value="<?=$_SESSION['user_login']['main_templink'];?>" name="main_url">

                                                <?php } else{ ?>

                                                    <input class="form-control" type="text" value="" placeholder="Enter Your URL here" name="main_url">

                                                <?php } ?>

                                                    <input class="form-control" type="hidden" value="<?= $_SESSION['user_login']['user_id']; ?>" placeholder="" name="user_id">

                                            </div>

                                        </div>

                                        

                                    </div>

                                    <div class="row clearfix">

                                        <div class="col-sm-3 col-lg-8">

                                            <div class="form-group c_form_group">
                                                <?php if(!empty($_SESSION['user_login']['aliastemp'])){ ?>

                                                    <input class="form-control" type="text" value="<?=$_SESSION['user_login']['aliastemp'];?>" placeholder="Alias" name="user_alias">
                                                <?php } else{ ?>

                                                    <input class="form-control" type="text" value="" placeholder="Alias" name="user_alias">

                                                <?php } ?>
                                            </div>

                                        </div>

                                        <div class="col-sm-3 col-lg-1"></div>

                                        <div class="col-sm-4 col-lg-3">

                                            <div class="form-group">

                                                <button type="submit" class="btn btn-primary radial">Short URL</button>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row clearfix">

                                        <div class="col-sm-12 col-lg-12">

                                            <div class="form-group c_form_group inner-group">

                                                <?php if(!empty($_SESSION['user_login']['temp_link'])){ ?>

                                                    <p id="generated_link1" style="display: none;"><?= $_SESSION['user_login']['temp_link']; ?> </p>

                                                    <p id="generated_link2" style="display: none;">none </p>

                                                <input class="form-control" type="text" value="<?= $_SESSION['user_login']['temp_link']; ?>" placeholder="Generate Link">

                                                <button type="button" class="btn radial copy-btn" onclick="copymainToClipboard('#generated_link1')">Copy</button>

                                                <?php } else{ ?>

                                                <input class="form-control" type="text" value="" placeholder="Generated Link Here">

                                                <button type="button" class="btn radial copy-btn" onclick="copymainToClipboard('#generated_link2')">Copy</button>

                                                <?php } ?>

                                            </div>

                                        </div>

                                        

                                    </div>

                                </div>

                            <?= form_close(); ?>

                        </div>

                    </div>

                    <div class="col-12">

                        <div class="card">

                            <div class="body">

                                <div class="row">

                                    <div class="col-lg-3 col-md-6">

                                        <div class="card card1">

                                            <div class="body">

                                                <div class="mt-3 h2"><?=  view_cell('\App\Controllers\Home::getTotalView', 'user_id='.$_SESSION['user_login']['user_id']);  ?></div>

                                                <div>Total Views</div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-3 col-md-6">

                                        <div class="card card2">

                                            <div class="body">

                                                <div class="mt-3 h2">$<?=  (float)view_cell('\App\Controllers\Home::getTotalEarnings', 'user_id='.$_SESSION['user_login']['user_id']);  ?></div>

                                                <div>Total Earnings</div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-3 col-md-6">

                                        <div class="card card3">

                                            <div class="body">

                                                <div class="mt-3 h2">$0.0000</div>

                                                <div>Referral Earnings</div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-3 col-md-6">

                                        <div class="card card4">

                                            <div class="body">

                                                <div class="mt-3 h2"><?= view_cell('\App\Controllers\Home::getAVGCPM', 'user_id='.$_SESSION['user_login']['user_id']);  ?></div>

                                                <div>AVG CPM</div>

                                            </div>

                                        </div>

                                    </div>

                                </div>         

                            </div>

                        </div>

                    </div>

                    <div class="col-12">

                            <div class="body">

                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                        <div class="empty-div"><span>Space For TEXT Information</span></div>

                                    </div>

                                </div>         

                            </div>

                    </div>

                </div>