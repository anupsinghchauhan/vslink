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
                            <p class="card-header">Withdrawal Amount should be Greater than or eqal to $10.0000</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card card1 withdraw-card">
                                            <div class="body">
                                                <div class="mt-3 h2"><?= $earning_count; ?>$</div>
                                                <div>Available Balance</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card card2 withdraw-card">
                                            <div class="body">
                                                <div class="mt-3 h2">$0.0000</div>
                                                <div>Pending Withdrawal</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card card4 withdraw-card">
                                            <div class="body">
                                                <div class="mt-3 h2">$0.0000</div>
                                                <div>Total Withdrawal</div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12"></div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <button class="withdraw-btn">Withdraw</button>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12"></div>
                                </div>        
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="col-12">
                            <div class="card">
                                <p class="card-header">You can Withdraw Money</p>
                                <div class="card-body">
                                    <h6>Payment Details:</h6>
                                    <div class="table-responsive m-t-35 col-lg-12 col-md-12 col-sm-12">
                                        <table class="display custom-table-data withdarwal_data" style="width:90%;">
                                            <thead>
                                                <tr>
                                                    <th class="colored">ID</th>
                                                    <th class="colored">Date</th>
                                                    <th>Status</th>
                                                    <th class="colored">Publisher Earnings</th>
                                                    <th class="colored">Referral Earnings</th>
                                                    <th>Total Amount</th>
                                                    <th>Withdrawal Method</th>
                                                    <th>Withdrawal Account</th>
                                                </tr>

                                            </thead>
                                            <hr/>
                                            <tbody>
                                                                        
                                            </tbody>
                                        </table>
                                        <hr/>
                                        <div class="instruction_withdraw">
                                            <ul>
                                                <li>Pending: The payment is being checked by our team. </li>
                                                <li>Approved: The payment has been approved and is waiting to be sent. </li>
                                                <li>Complete: The payment has been successfully sent to your payment account.</li>
                                                <li>Cancelled: The payment has been cancelled. </li>
                                                <li>Returned: The payment has been returned to your account.  </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>