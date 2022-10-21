
     <!-- Page header section  -->
<!-- The actual snackbar -->
<div id="refersnackbar">Link Copied Successfully!</div>
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
                                                        <h3>Settings</h3>
                                                    </div>
                                                    
                                                </div>
                                                <div class="card manage-link-card">
                                                    <div class="card-header">
                                                        Billing Address
                                                    </div>
                                                    <div class="card-body">

                                                        <?= form_open('user/submit_billing_details', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php if(isset($billing_data->firstname)){ echo $billing_data->firstname;} ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php if(isset($billing_data->lastname)){ echo $billing_data->lastname;} ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <textarea  name="address" class="form-control" placeholder="Address"><?php if(isset($billing_data->address)){ echo $billing_data->address;} ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                       <select name="country" class="form-control" id="countryname"> 

                                                                            <option selected disabled>Select Country</option>

                                                                            <?php 
                                                                                    if(!empty($countries_data)){
                                                                                     foreach ($countries_data as $key => $value) {   
                                                                            ?>
                                                                                        <option value="<?= $value->id;?>" <?php if(isset($billing_data->country) && $billing_data->country == $value->id){ echo "selected";} ?>><?= $value->name ; ?></option>
                                                                            <?php } } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <select name="state" class="form-control" id="states"> 

                                                                        <?php  
                                                                            if(isset($billing_data->country)){ 
                                                                                $states = !empty($states_data)? $states_data : ''; 
                                                                                foreach ($states as $key => $value) {   
                                                                        ?>
                                                                                        <option value="<?= $value->id;?>" <?php if(isset($billing_data->state) && $billing_data->state == $value->id){ echo "selected";} ?>><?= $value->name ; ?></option>
                                                                        <?php } }else { ?>
                                                                           
                                                                            <option selected disabled>Select state</option>

                                                                        <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="zipcode" class="form-control" placeholder="Zip Code" value="<?php if(isset($billing_data->zipcode)){ echo $billing_data->zipcode;} ?>" id="zipcode">
                                                                        <!-- Error -->
                                                                        <?php if($validation->getError('zipcode')) {?>
                                                                            <div class='alert alert-danger mt-2'>
                                                                              <?php echo $validation->getError('zipcode'); ?>
                                                                            </div>
                                                                        <?php }?>
                                                                        <span class="notzipcode" style="color: red;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="city" class="form-control" placeholder="City" value="<?php if(isset($billing_data->city)){ echo $billing_data->city;} ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php if(isset($billing_data->phone)){ echo $billing_data->phone;} ?>" id="phoneno">
                                                                        <!-- Error -->
                                                                        <?php if($validation->getError('phone')) {?>
                                                                            <div class='alert alert-danger mt-2'>
                                                                              <?php echo $validation->getError('phone'); ?>
                                                                            </div>
                                                                        <?php }?>
                                                                        <span class="notphoneno" style="color: red;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?= form_close(); ?>
                                                       
                                                       
                                                        <hr/>
                                                        <div class="card-header">
                                                            Payment Information
                                                        </div>
                                                         <?= form_open('user/do_addpayment_info', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>
                                                        <div class="row m-t-35">
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <h6>Withdrawl Info (Choose One):</h6>
                                                                <div class="row m-t-35">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                                <select class="form-control payment_method" name="payment_method">
                                                                                    <option value="upi" <?php if(!empty($payment_info_data) && $payment_info_data->payment_method == 'upi'){ echo "selected";}  ?>>UPI</option>
                                                                                    <option value="paypal" <?php if(!empty($payment_info_data) && $payment_info_data->payment_method == 'paypal'){ echo "selected";}  ?>>Paypal</option>
                                                                                    <option value="paytm" <?php if(!empty($payment_info_data) && $payment_info_data->payment_method == 'paytm'){ echo "selected";}  ?>>Paytm</option>
                                                                                    <option value="bank" <?php if(!empty($payment_info_data) && $payment_info_data->payment_method == 'bank'){ echo "selected";}  ?>>Bank Transfer(India)</option>
                                                                                </select>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h6>Payment Information:</h6>

                                                                <div class="empty-div withdrawal-div">
                                                                    <h4 class="payment_info_title">Fill Below Details</h4><!-- <span>Seek Information w.r.t preferred Withdrawal Method</span> -->
                                                                    

                                                                                <div class="upi_form" style="<?php if(!empty($payment_info_data) && $payment_info_data->payment_method == 'upi'){ echo "display: block;";}else{ echo "display: none;";}  ?>">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                                                                            <div class="form-group">
                                                                                                <input type="text" name="upi_id" class="form-control" placeholder="Enter UPI ID" value="<?php echo $payment_info_data->upi_id;  ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                    
                                                                                <div class="paypal_form" style="<?php if(!empty($payment_info_data) && $payment_info_data->payment_method == 'paypal'){ echo "display: block;";}else{ echo "display: none;";}  ?>">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                                                                            <div class="form-group">
                                                                                                <input type="text" name="paypal_email" class="form-control" placeholder="Enter Your Email ID" value="<?php  echo $payment_info_data->paypal_email;  ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                    
                                                                                <div class="paytm_form" style="<?php if(!empty($payment_info_data) && $payment_info_data->payment_method == 'paytm'){ echo "display: block;";}else{ echo "display: none;";}  ?>">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                                                                            <div class="form-group">
                                                                                                <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile Number" value="<?php  echo $payment_info_data->paytm_mobile;  ?>"> 
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                   
                                                                                <div class="bank_form" style="<?php if(!empty($payment_info_data) && $payment_info_data->payment_method == 'bank'){ echo "display: block;";}else{ echo "display: none;";}  ?>">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                                                                            <div class="form-group">
                                                                                                <input type="text" name="fname" class="form-control" placeholder="Enter First Name" value="<?php  echo $payment_info_data->bank_fname;  ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                                                                            <div class="form-group">
                                                                                                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" value="<?php  echo $payment_info_data->bank_lname;  ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                                                                            <div class="form-group">
                                                                                                <input type="text" name="ifsc_code" class="form-control" placeholder="Enter IFSC Code" value="<?php  echo $payment_info_data->bank_IFSCcode;  ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                                                                            <div class="form-group">
                                                                                                <input type="text" name="acc_no" class="form-control" placeholder="Enter Account Number" value="<?php  echo $payment_info_data->bank_accountno;  ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                                                    


                                                                    <div class="row">
                                                                            <div class="col-lg-4 col-sm-12 col-md-12"></div>
                                                                            <div class="col-lg-4 col-sm-12 col-md-12">
                                                                                <div class="form-group">
                                                                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-sm-12 col-md-12"></div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="table-responsive">
                                                                    <table id="" class="display custom-table-data payment_method_table" style="width:100%;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Details</th>
                                                                                <th>Method</th>
                                                                                <th>Minimum Withdrawal Amount (Daily)</th>
                                                                                <th>Max Withdrawal Amount ( in Week )</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="20">Enter UPI ID</td>
                                                                                <td width="60">UPI</td>
                                                                                <td width="40">$5</td>
                                                                                <td width="40">$50</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="20">Enter Mobile Number</td>
                                                                                <td>Paytm</td>
                                                                                <td>$10</td>
                                                                                <td>$50</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="20">Add First Name, Last Name, IFSC Code,Account Number </td>
                                                                                <td>Bank Transfer</td>
                                                                                <td>$15</td>
                                                                                <td>$50</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="20">Add your Email ID</td>
                                                                                <td>Paypal</td>
                                                                                <td>$20</td>
                                                                                <td>$100</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?= form_close(); ?>
                                                        <hr/>
                                                        <div class="card-header">
                                                            Manage CPM
                                                        </div>
                                                          <?= form_open('user/cpm_settings', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>
                                                            <div class="row m-t-35">
                                                            
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="form-group">
                                                                        <select class="form-control show-tick" name="cpm_settings">
                                                                            <?php $avg_cpm =   view_cell('\App\Controllers\User::getCPM', 'user_id='.$_SESSION['user_login']['user_id']);  ?>
                                                                            <option value="">- CPM -</option>
                                                                            <option value="2.5 for 5 sec" <?php if(isset($avg_cpm) && $avg_cpm == '2.5 for 5 sec'){ echo "selected"; }?>>USD $2.5 for 5 sec delay</option>
                                                                            <option value="4 for 14 sec" <?php if(isset($avg_cpm) && $avg_cpm == '4 for 14 sec'){ echo "selected"; }?>>USD $4 for 15 Sec Delay</option>
                                                                            <option value="6 for 25 sec" <?php if(isset($avg_cpm) && $avg_cpm  == '6 for 25 sec'){ echo "selected"; }?>>USD $6 for 25 Sec Delay</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2 col-sm-12 col-md-2">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?= form_close(); ?>
                                                        
                                                    </div>

                                                    </div>
                                                </div>
                                                <div class="m-t-35"></div>
                                                <div class="card manage-link-card">
                                                    <div class="card-header">
                                                        Refer To A Friend
                                                    </div>
                                                    <div class="card-body">
                                                        <h5>Generate Link and Share with Your Friend</h5>

                                                        <hr/>
                                                        <div class="referral_code_div col-4">
                                                            <span>Referal Code : <?=  $_SESSION['user_login']['referralcode'];?></span>
                                                        </div>
                                                        <hr/>
                                                        <div class="refer_link">
                                                            
                                                            <div class="col-lg-12 col-sm-12 col-md-6">
                                                                <button onclick="copyreferToClipboard('#referrallink')" class="btn btn-sm btn-mng-copy">Generate & Copy</button> 
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-md-6">
                                                                <p class="referral_linktext" id="referrallink" style="display:none;"><?= base_url('/register?referral='.encryptor($_SESSION['user_login']['referralcode'])); ?></p>
                                                            </div>
                                                        </div>
                                                         
                                                    </div>




                                                </div>
                                                <div class="m-t-35"></div>
                                                <div class="card manage-link-card">
                                                    <div class="card-header">
                                                        Update Profile Details
                                                    </div>
                                                    <div class="card-body">
                                                        <?= form_open('auth/change_password', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>
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

                                                        <hr/>

                                                         <?= form_open('auth/change_email', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?>
                                                            <div class="row m-t-35">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        
                                                                        <input type="text" name="current_email" class="form-control" placeholder="Current Email" value="<?=  $_SESSION['user_login']['Email_ID'];  ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="new_email" class="form-control" placeholder="New Email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="confirm_new_email" class="form-control" placeholder="Re-enter New Email">
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

                        