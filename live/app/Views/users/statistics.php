     <!-- Page header section  -->

     <div class="card manage-link-card">

                
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
                                                        <h3>Statistics</h3>
                                                    </div>
                                                    <div>
                                                        <div class="btn-group mb-3">
                                                           <!--  <div class="btn-group" role="group">
                                                                <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">14 March 2020</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0);">Today’s</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);">This Week</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);">Last Week</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);">This Month</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);">Last 12 Month</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);">Custom Dates</a>
                                                                </div>
                                                            </div> -->
                                                            <!-- <button type="button" class="btn btn-default"><i class="fa fa-send"></i> <span class="hidden-md">Report</span></button>
                                                            <button type="button" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> <span class="hidden-md">Export</span></button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <!-- <div class="header"> -->
                                                        <!-- <ul class="header-dropdown dropdown">
                                                            <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li> -->
                                                            <!-- <li class="dropdown">
                                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                                                <ul class="dropdown-menu theme-bg gradient">
                                                                    <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a></li>
                                                                    <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a></li>
                                                                    <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>
                                                                    <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a></li>
                                                                    <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>
                                                                    <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>
                                                                </ul>
                                                            </li> -->
                                                        <!-- </ul> -->
                                                    <!-- </div> -->
                                                    <div class="body">
                                                        <div class="d-flex flex-row">
                                                            <div class="pb-3">
                                                                <h5 class="mb-0">Earnings</h5>
                                                            </div>
                                                           
                                                           
                                                        </div>
                                                        <!-- <div id="chartContainer" style="height: 300px; max-width: 100%; margin: 0px auto;"></div> -->
                                                        <div style="width:75%;">
                                                            <div class="chartjs-size-monitor">
                                                                <div class="chartjs-size-monitor-expand">
                                                                    <div class=""></div>
                                                                </div>
                                                                <div class="chartjs-size-monitor-shrink">
                                                                    <div class=""></div>
                                                                </div>
                                                            </div>
                                                            <canvas id="canvas" style="display: block; width: 1500px; height: 1500px;" width="1379" height="1500" class="chartjs-render-monitor"></canvas>
                                                        </div>
                                                       <!--  <div id="flotChart" class="flot-chart"></div> -->
                                                    </div>
                                                </div>

                                           

                                    </div>

                                </div>

                            </div>

                            

                        </div>

                    </div>


                    
                </div>
                <div class="row clearfix manage-link-card">

                            <div class="col-lg-6 col-12 col-sm-12 col-md-12 mb-30">

                                <div class="box">

                                    <div class="box-body">
                                        <div class="statistics-header m-t-25 m-b-30 row">
                                            <div class="col-lg-6 col-md-6 col-sm-12"></div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <select class="form-control month-selector" name="monthwisestatis">
                                                    <option selected disabled>Select Month</option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>

                                        </div>

                                        <table id="" class="display custom-table-data statistics-table">
                                                            <thead>
                                                               <tr>
                                                                  <th>Date</th>
                                                                  <th>Views</th>
                                                                  <th>AVG. CPM</th>
                                                                  <th>Earning</th>
                                                               </tr>
                                                            </thead>
                                                            <tbody class="monthwisedata">
                                                                <?php 
                                                                    if(!empty($monthwisedate)){

                                                                        foreach ($monthwisedate as $key => $value) {    
                                                                            $month = date('m', strtotime($value->viewed_on)); 
                                                                                if($month == date('m')){

                                                                ?>

                                                                <tr>

                                                                    <td><?php echo date('d-M-y', strtotime($value->viewed_on)); ?></td>
                                                                    <td><?php echo $value->c; ?></td>
                                                                    <td><?= view_cell('\App\Controllers\Home::getAVGCPM', 'user_id='.$_SESSION['user_login']['user_id']);  ?></td>
                                                                    <td><?php $total_earnings = $value->c *  view_cell('\App\Controllers\Home::getAVGCPM', 'user_id='.$_SESSION['user_login']['user_id']) * 0.001; echo $total_earnings; ?></td> 


                                                                </tr>

                                                              <?php } } } ?>



                                                            </tbody>



                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                            <div class="col-lg-6 col-12 col-sm-12 col-md-12 mb-30">

                                <div class="box">

                                    <div class="box-body">
                                        
                                        <div class="empty-div"><span>Ads</span></div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
<style type="text/css">
    @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}
    .chartjs-render-monitor{animation:chartjs-render-animation 1ms}
    .chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}
    .chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}
    .chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
</style>
<script type="text/javascript" src="https://cdn2.hubspot.net/hubfs/476360/Chart.js"></script>   
<script type="text/javascript" src="https://cdn2.hubspot.net/hubfs/476360/utils.js"></script>          
          
<script type="text/javascript">
  // window.onload = function () {
  //   var chart = new CanvasJS.Chart("chartContainer",
  //   {
  //     axisX:{
  //      interval: 1,
  //      intervalType: "day",
  //    },
  //    axisY:{
  //      interval: 1,
  //      includeZero: true
  //    },
  //     data: [
  //     {
  //       type: "area",

  //       dataPoints: [
  //           <?php //if(!empty($monthwisedate)){
  //           foreach ($monthwisedate as $key => $value) {    
  //               $month = date('m', strtotime($value->viewed_on));
  //               $dateY = strtotime($value->viewed_on)*1000;                
  //               if($month == date('m')){ ?>
  //               { x: new Date(<?php //echo $dateY; ?>), y: <?php //echo $value->c; ?> },            
  //           <?php //} } } ?>        
  //       ]
  //     }
  //     ] 
  //   });

  //   chart.render();
  // }
  var config = {
        type: 'line',
        data: {

            labels: [
                <?php if(!empty($monthwisedate)){
                 foreach ($monthwisedate as $key => $value) {    
                 $month = date('m', strtotime($value->viewed_on));
                 $dateY = date('d-M-Y', strtotime($value->viewed_on));                
                 if($month == date('m')){ ?>
                    '<?php echo $dateY;?>',         
                <?php } } } ?>  
            ],
            datasets: [{
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                fill: false,
                data: [
                    <?php if(!empty($monthwisedate)){
                 foreach ($monthwisedate as $key => $value) {    
                 $month = date('m', strtotime($value->viewed_on));
                 $dateY = date('d-M-Y', strtotime($value->viewed_on));                
                 if($month == date('m')){ ?>
                    <?php echo $value->c;?>,         
                <?php } } } ?>
                    /*randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()*/
                ],
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false,
                text: 'Chart.js Line Chart - Logarithmic'
            },
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    display: true,
                  scaleLabel: {
                    display: false,
                    labelString: 'Date'
                  },            
            }],
            yAxes: [{
                display: true,
                //type: 'logarithmic',
                scaleLabel: {
                    display: false,
                    labelString: 'Index Returns'
                },
                ticks: {
                    min: 0,
                    max: 5000,

                            // forces step size to be 5 units
                    stepSize: 150
                }
            }]
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };

    document.getElementById('randomizeData').addEventListener('click', function() {
        config.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });

        });

        window.myLine.update();
    }); 
  </script>