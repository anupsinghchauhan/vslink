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
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Total <br/>Generated Links</th>
                                                    <th>Total Views</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                       if(!empty($users_data)){
                                                            $cnt = 1;
                                                            foreach ($users_data as $key => $value) {  
                                                    ?>
                                                                    <tr>
                                                                        <td width=""><?= $cnt; ?></td>
                                                                        <td width=""><?= $value->name; ?></td>
                                                                        <td width=""><?= $value->username; ?></td>
                                                                        <td width=""><?= $value->email; ?></td>
                                                                        <td width=""><?=  view_cell('\App\Controllers\Home::getgeneratedlinksCount', 'user_id='.$value->user_id);  ?></td>
                                                                        <td width=""><?=  view_cell('\App\Controllers\Home::getTotalView', 'user_id='.$value->user_id);  ?></td>
                                                                    </tr>
                                                <?php $cnt++; } } ?>
                                                

                                                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>