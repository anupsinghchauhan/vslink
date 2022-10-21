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

                                <div class="card-body">

                                    <h6>Users   :</h6>

                                    <div class="table-responsive m-t-35 col-lg-12 col-md-12 col-sm-12">

                                        <table border="1" id="example3" class="display custom-table-data" style="width:90%;">

                                            <thead>

                                                <tr>

                                                    <th>ID</th>

                                                    <th>Name</th>

                                                    <th>Email</th>

                                                    <th>Subject</th>

                                                    <th>Message</th>

                                                    <th>Query Sent On</th>

                                                    <th>Reply</th>

                                                    <th></th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php 

                                                       if(!empty($queries_data)){

                                                            $cnt = 1;

                                                            foreach ($queries_data as $key => $value) {  

                                                    ?>

                                                                    <tr>

                                                                        <td width=""><?= $cnt; ?></td>

                                                                        <td width=""><?= $value->name; ?></td>

                                                                        <td width=""><?= $value->email_address; ?></td>

                                                                        <td width=""><?= $value->subject; ?></td>

                                                                        <td width=""><?= $value->message; ?></td>

                                                                        <td width=""><?= date('d-M-Y',strtotime($value->dated_on)); ?></td>

                                                                        <td width=""><?= form_open('admin/do_reply_onhome', ['class' => 'needs-validation', 'novalidate' => '', 'autocomplete' => 'off']); ?><input type="hidden" name="date" value="<?= $value->dated_on; ?>"><input type="hidden" name="name" value="<?= $value->name; ?>"><input type="hidden" name="email_address" value="<?= $value->email_address; ?>"><textarea name="reply_to_query" placeholder="Reply.." class="form-control"></textarea></td>

                                                                        <td><button type="submit" class="query-btn">Send</button><?= form_close(); ?></td>

                                                                    </tr>

                                                <?php $cnt++; } } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                        </div>

                    </div>

                </div>