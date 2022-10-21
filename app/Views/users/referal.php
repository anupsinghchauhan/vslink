 <!-- Page header section  -->
<!-- The actual snackbar -->
<div id="referpagesnackbar">Link Copied Successfully!</div>
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

                    <div class="col-8">

                        <div class="card">

                            <p class="referal-header card-header ">The vslinq.com | Earn Money on short links referral program is a great way to spread the word of this great service and to earn even more money with your Short Links! Refer Friends and receive 20% of their earnings for Life!</p>

                        </div>

                    </div>

                    <div class="col-12">

                        <div class="card">

                            <div class="body">

                                <div class="row">

                                    

                                    <div class="col-lg-4 col-md-6 col-sm-12">

                                        <div class="referral_code_div">

                                            <span>Referal Code : <?=  $_SESSION['user_login']['referralcode'];?></span>

                                        </div>

                                    </div>

                                </div> 
                                <div class="refer_link m-t-35">
                                                            
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                        <button onclick="copyreferpageToClipboard('#referralpagelink')" class="btn btn-sm btn-mng-copy">Generate & Copy</button> 
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                        <p class="referral_linktext" id="referralpagelink" style="display:none;"><?= base_url('/register?referral='.encryptor($_SESSION['user_login']['referralcode'])); ?></p>
                                    </div>
                                </div>

                                      

                            </div>

                        </div>

                    </div>

                    <div class="col-12">

                        <div class="col-12">

                            <div class="card">

                                <p class="referal-header card-header">My Referrals</p>

                                <div class="card-body">

                                   

                                    <div class="table-responsive m-t-35 col-lg-5 col-md-12 col-sm-12">

                                        <table border="1" id="referral" class="display custom-table-data" style="width:90%;">

                                            <thead>

                                                <tr>

                                                    <th>username</th>

                                                    <th>Date</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php 

                                                    if(!empty($referrals_data)){

                                                        foreach ($referrals_data as $key => $value) { ?>

                                                <tr>

                                                    <td width=""><?= view_cell('\App\Controllers\User::getusername', 'user_id='.$value->username);  ?></td>

                                                    <td width=""><?= date('d-M-y', strtotime($value->Added_on));?></td>

                                                </tr>

                                                <?php }} ?>



                                                                           

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>



                        </div>

                    </div>

                </div>