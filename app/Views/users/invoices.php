<!-- Page header section  -->
<div class="card manage-link-card">
    <?php if($session->has('success')){ ?>
        <div class="alert alert-success alert-dismissible show">
            <div class="alert-body">
                <button class="close" data-dismiss="alert"> <span>&times;</span> </button>
                <?= $session->getFlashdata('success'); ?>
            </div>
        </div>
    <?php }elseif ($session->has('error')) { ?>
        <div class="alert alert-danger alert-dismissible show">
            <div class="alert-body">
                <button class="close" data-dismiss="alert"> <span>&times;</span> </button>
                <?= $session->getFlashdata('error'); ?>
            </div>
        </div>
    <?php } ?>
    <div class="clearfix">
        <div class="box">
            <div class="box-body">
                <div class="section_title">
                    <div class="mr-3">
                        <h3>Manage Invoices</h3> </div>
                    </div>
                    <table id="example2" class="display custom-table-data">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Channel</th>
                                <th>Amounts</th>
                                <th>Paid Date</th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
            </div>
        </div>
    </div>
</div