     <!-- The actual snackbar -->
<div id="snackbar">Copied Successfully!</div>
     <!-- Page header section  -->

     <div class="card manage-link-card">

                    <div class="block-header">

                        <div class="row clearfix">



                                <div class="col-lg-4 col-md-12 col-sm-12">

                                    <h1>Manage Links</h1>

                                </div>

                          

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

                            <div class="col-lg-12 col-12 mb-30">

                                <div class="box">

                                    <div class="box-body">

                                        <ul class="nav nav-pills mb-15">

                                            <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#home6"><input type="radio" name="" value="All Links">&nbsp; All Links</a></li>

                                            <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#profile6"><input type="radio" name="">&nbsp;  Hidden Links</a></li>

                                        </ul>

                                        <div class="tab-content">

                                            <div class="tab-pane fade show active" id="home6">

                                                <div class="card">

                                                    <div class="table-responsive">



                                                        <table id="example" class="display custom-table-data">



                                                            <thead>



                                                               <tr>



                                                                  <th>Serial No.</th>



                                                                  <th>Main Link</th>



                                                                  <!-- <th>Link Alias</th> -->



                                                                  <th>Generated Link</th>



                                                                  <th>Date</th>



                                                                  <th>Status</th>



                                                                  <th>Copy Link</th>



                                                                  <th>Actions</th>



                                                               </tr>



                                                            </thead>



                                                            <tbody>

                                                                <?php 

                                                               if(!empty($links_data)){

                                                                    $cnt = 1;

                                                                    foreach ($links_data as $key => $value) {    



                                                                    if($value->available == '0'){

                                                                            $Status = "<span class='badge badge-danger'>Hidden</span>";

                                                                        } elseif($value->available == '1'){

                                                                            $Status = "<span class='badge badge-success'>Open</span>";

                                                                        }

                                                                        if(!empty($value->alias)){ $alias = $value->alias; } else if(!empty($value->generated_alias)){ $alias = $value->generated_alias; }

                                                                                                                    

                                                                ?>

                                                                <tr>

                                                                    <td><?= $cnt; ?></td>

                                                                    <td><?= $value->main_link; ?></td>

                                                                    <!-- <td><?= $alias; ?></td>  -->

                                                                    <td><?php if(!empty($value->alias)){ ?> <a href="<?= base_url('/'.$value->alias); ?>"><p id="<?= $cnt;?>link"><?= $value->generated_link; ?></p></a> 

                                                                        <?php  } else if(!empty($value->generated_alias)){ ?> <a href="<?= base_url('/'.$value->generated_alias); ?>"><p id="<?= $cnt;?>link"><?= $value->generated_link; ?></p></a> <?php  } ?>
                                                                        
                                                                    </td> 

                                                                    <td><?= $value->created_on;?></td>  

                                                                    <td><?= $Status; ?></td>

                                                                    <td>

                                                                        <button onclick="copyToClipboard('#<?= $cnt;?>link')" class="btn btn-sm btn-mng-copy">Copy</button><!-- <a href="#" class="btn btn-sm btn-mng-copy" title="Copy">Copy</a> -->

                                                                    </td>

                                                                    <td>


                                                                        <p></p>

                                                                        <?php if($value->available == '1'){ ?>

                                                                            <a href="javascript:;" class="btn btn-sm hide_link hide-btn" title="Hide" id="<?= $value->link_id; ?>">Hide</a>

                                                                        <?php } else if($value->available == '0'){ ?>

                                                                            <a href="javascript:;" class="btn btn-sm show_link hide-btn" title="Show" id="<?= $value->link_id; ?>">Show</a>

                                                                        <?php } ?>

                                                                    </td>       

                                                                    

                                                                </tr>

                                                              <?php $cnt++;  }} ?>



                                                            </tbody>



                                                        </table>



                                                    </div>

                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="profile6">

                                                <div class="card">

                                                    <div class="table-responsive">



                                                        <table id="example2" class="display custom-table-data">



                                                            <thead>



                                                               <tr>



                                                                  <th>Serial No.</th>



                                                                  <th>Main Link</th>



                                                                  <th>Link Alias</th>



                                                                  <th>Generated Link</th>



                                                                  <th>Date</th>



                                                                  <th>Status</th>



                                                                  <th>Copy Link</th>



                                                                  <th>Actions</th>



                                                               </tr>



                                                            </thead>



                                                            <tbody>

                                                                <?php 

                                                               if(!empty($links_data)){

                                                                    $cnt = 1;

                                                                    foreach ($links_data as $key => $value) {    



                                                                    if($value->available == '0'){

                                                                            $Status = "<span class='badge badge-danger'>Hidden</span>";

                                                                        } elseif($value->available == '1'){

                                                                            $Status = "<span class='badge badge-success'>Open</span>";

                                                                        }

                                                                        if(!empty($value->alias)){ $alias = $value->alias; } else if(!empty($value->generated_alias)){ $alias = $value->generated_alias; }

                                                                        if($value->available == '0'){

                                                                                                                    

                                                                ?>

                                                                <tr>

                                                                    <td><?= $cnt; ?></td>

                                                                    <td><?= $value->main_link; ?></td>

                                                                    <td><?= $alias; ?></td> 

                                                                    <td><?php if(!empty($value->alias)){ ?> <a href="<?= base_url('/'.$value->alias); ?>"><p id="<?= $cnt;?>link"><?= $value->generated_link; ?></p></a> 

                                                                        <?php  } else if(!empty($value->generated_alias)){ ?> <a href="<?= base_url('/'.$value->generated_alias); ?>"><p id="<?= $cnt;?>"><?= $value->generated_link; ?></p></a> <?php  } ?>
                                                                    </td> 

                                                                    <td><?= $value->created_on;?></td>  

                                                                    <td><?= $Status; ?></td>

                                                                    <td>

                                                                        <button onclick="copyToClipboard('#<?= $cnt;?>link')" class="btn btn-sm btn-mng-copy">Copy</button>

                                                                    </td>

                                                                    <td>


                                                                        <p></p>

                                                                        <?php if($value->available == '1'){ ?>

                                                                            <a href="javascript:;" class="btn btn-sm hide_link hide-btn" title="Hide" id="<?= $value->link_id; ?>">Hide</i></a>

                                                                        <?php } else if($value->available == '0'){ ?>

                                                                            <a href="javascript:;" class="btn btn-sm show_link hide-btn"  title="Show" id="<?= $value->link_id; ?>">Show</a>

                                                                        <?php } ?>

                                                                    </td>       

                                                                    

                                                                </tr>

                                                              <?php $cnt++; } }} ?>



                                                            </tbody>



                                                        </table>



                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                        </div>

                    </div>

                </div>

                        