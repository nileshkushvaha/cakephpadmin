<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \June 22, 2020, 11:57 am
 * @var \App\View\AppView $this
 */
use Cake\Filesystem\File;
?>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?= $this->Number->format($totalDriver) ?></h3>
          <p>Total Drivers</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <?= $this->Html->link(__('More info <i class="fa fa-arrow-circle-right"></i>'),['controller'=>'drivers','action'=>'index'],['escape'=>false,'class'=>'small-box-footer']);?>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $this->Number->format($totalClient) ?></h3>
          <p>Total Clients</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
        <?= $this->Html->link(__('More info <i class="fa fa-arrow-circle-right"></i>'),['controller'=>'clients','action'=>'index'],['escape'=>false,'class'=>'small-box-footer']);?>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $this->Number->format($totalOpening) ?></h3>
          <p>Total Job Request</p>
        </div>
        <div class="icon">
          <i class="ion ion-briefcase"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $this->Number->format($totalHiredDriver) ?></h3>
          <p>Total Hired Drivers</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-4">
      <!-- USERS LIST -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">New Drivers</h3>
          <div class="box-tools pull-right">
            <span class="label label-danger">4 New Members</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <ul class="users-list clearfix">
            <?php if (!empty($latestDrivers)) {
              foreach ($latestDrivers as $key => $latestDriver) { ?>
                <li>
                  <?php if (!empty($latestDriver['user_profile']['profile_photo'])) {
                    echo $this->Html->image('/files/profiles/'.$latestDriver['id'].'/'.$latestDriver['user_profile']['profile_photo'],['alt'=>$latestDriver['name'],'style'=>['width:66px;height:66px;']]);
                    } else {
                      echo $this->Html->image('/assets/img/user-100.png',['alt'=>'Driver-'.$key,'style'=>['width:66px;height:66px;']]);
                    } ?>
                  <a class="users-list-name" href="javascript:void(0)"><?=$latestDriver['name']?></a>
                  <span class="users-list-date"><?=date('m-d-Y',strtotime($latestDriver['created'])) ?></span>
                </li>
              <?php } 
            } else {
              echo "<p> No Drivers </p>";
            } ?>                  
          </ul>
          <!-- /.users-list -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          <?= $this->Html->link(__('View All Drivers'),['controller'=>'drivers','action'=>'index'],['escape'=>false,'class'=>'uppercase']);?>
        </div>
        <!-- /.box-footer -->
      </div>
      <!--/.box -->
    </div>

    <div class="col-md-4">
      <!-- USERS LIST -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">New Clients</h3>
          <div class="box-tools pull-right">
            <span class="label label-danger">4 New Members</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <ul class="users-list clearfix">
            <?php if (!empty($latestClients)) {
              foreach ($latestClients as $key => $latestClient) { ?>
                <li>
                  <?php if (!empty($latestClient['user_profile']['profile_photo'])) {
                    echo $this->Html->image('/files/profiles/'.$latestClient['id'].'/'.$latestClient['user_profile']['profile_photo'],['alt'=>$latestClient['name'],'style'=>['width:66px;height:66px;']]);
                    } else {
                      echo $this->Html->image('/assets/img/user-100.png',['alt'=>'Driver-'.$key,'style'=>['width:66px;height:66px;']]);
                    } ?>
                  <a class="users-list-name" href="javascript:void(0)"><?=$latestClient['name']?></a>
                  <span class="users-list-date"><?=date('m-d-Y',strtotime($latestClient['created'])) ?></span>
                </li>
              <?php } 
            } else {
              echo "<p> No Drivers </p>";
            } ?>                 
          </ul>
          <!-- /.users-list -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          <?= $this->Html->link(__('View All Clients'),['controller'=>'Clients','action'=>'index'],['escape'=>false,'class'=>'uppercase']);?>
        </div>
        <!-- /.box-footer -->
      </div>
      <!--/.box -->
    </div>

    <div class="col-md-4">
      <!-- USERS LIST -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Hired Drivers</h3>
          <div class="box-tools pull-right">
            <span class="label label-danger">4 New Members</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <ul class="users-list clearfix">            
            <?php if (!empty($latestHiredDriver)) {
              foreach ($latestHiredDriver as $key => $latestHired) { ?>
                <li>
                  <?php if (!empty($latestHired->driver->user_profile->profile_photo)) {
                    echo $this->Html->image('/files/profiles/'.$latestHired->driver->id.'/'.$latestHired->driver->user_profile->profile_photo,['alt'=>$latestHired->driver->name,'style'=>['width:66px;height:66px;']]);
                    } else {
                      echo $this->Html->image('/assets/img/user-100.png',['alt'=>'Driver-'.$key,'style'=>['width:66px;height:66px;']]);
                    } ?>
                  <a class="users-list-name" href="javascript:void(0)"><?=$latestHired->driver->name?></a>
                  <span class="users-list-date"><?=date('m-d-Y',strtotime($latestHired->driver->created)) ?></span>
                </li>
              <?php } 
            } else {
              echo "<p> No Drivers </p>";
            } ?>                   
          </ul>
          <!-- /.users-list -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          <a href="javascript:void(0)" class="uppercase">View All Users</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!--/.box -->
    </div>
  </div>

  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Generated Invoice Amount</span>
          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="info-box-number"><?= $this->Number->format($generateAmountAdmin)?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-euro"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Paid Amount by Clients</span>
          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="info-box-number"><?= $this->Number->format($totalPaidAmount)?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">No. of Invoices</span>
          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="info-box-number"><?= $this->Number->format($noOfInvoices)?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-euro"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">No. of Invoices Paid by Client</span>
          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="info-box-number"><?= $this->Number->format($noOfInvoicePaidClient)?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <!-- BAR CHART -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Drivers & Clients Registration </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart" style="height:300px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Invoices</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>Invoice ID</th>
                  <th>Worksheet Id</th>
                  <th>Client</th>
                  <th>Driver</th>
                  <th>From Date</th> 
                  <th>To Date</th>
                  <th>Status</th>
                  <th>Client Status </th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($latestInvoices)) {
                  foreach ($latestInvoices as $key => $worksheet) { ?>
                    <tr>
                      <td><?php if(!empty($worksheet->invoice_name)){
                      $filePath = UPLOAD_FILE.'invoices/'. $worksheet->invoice_name;
                      $fileExits = new File($filePath, false, 0777);
                      if($fileExits->exists()){ ?>
                        <a title="View" target="_blank" class="view-file" href="<?= $this->Url->build('/files/invoices/'. $worksheet->invoice_name);?>"> <?= ucfirst($worksheet->invoice_number)?></a>
                      <?php }
                      } ?></td>
                      <td><?= h($worksheet->worksheetid)?></td>                      
                      <td><?= h($worksheet->client->name)?></td>
                      <td><?= h($worksheet->driver->name)?></td>
                      <td><?= date('m-d-Y',strtotime($worksheet->from_date))?></td>
                      <td><?= date('m-d-Y',strtotime($worksheet->to_date))?></td>
                      <?php $labelClassA=$labelClassB='';
                      if ($worksheet->admin_status=='paid') {
                        $labelClassA='label label-success';
                      } elseif ($worksheet->admin_status=='pending') {
                        $labelClassA='label label-warning';
                      }
                      if ($worksheet->client_status=='paid') {
                        $labelClassB='label label-success';
                      } elseif ($worksheet->client_status=='pending') {
                        $labelClassB='label label-warning';
                      }
                      ?>
                      <td><span class="<?=$labelClassA;?>"><?= ucfirst($worksheet->admin_status)?></span></td>
                      <td><span class="<?=$labelClassB;?>"><?= ucfirst($worksheet->client_status)?></span></td>
                    </tr>
                  <?php }
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <?= $this->Html->link(__('Create New Invoice'),['controller'=>'worksheets','action'=>'create-invoice'],['escape'=>false,'class'=>'btn btn-sm btn-info btn-flat pull-left']);?>
          <?= $this->Html->link(__('View All Invoices'),['controller'=>'worksheets','action'=>'generated-invoices'],['escape'=>false,'class'=>'btn btn-sm btn-default btn-flat pull-right']);?>
        </div>
        <!-- /.box-footer -->
      </div>
    </div>

  </div>


</section>
<!-- /.content -->
<?php
$this->Html->script(['AdminLTE./plugins/chartjs/Chart.min.js'],['block' => 'script']);
?>
<?php 
$d_jan=$d_feb=$d_mar=$d_apr=$d_may=$d_jun=$d_jul=$d_aug=$d_sep=$d_oct=$d_nov=$d_dec=0;
$c_jan=$c_feb=$c_mar=$c_apr=$c_may=$c_jun=$c_jul=$c_aug=$c_sep=$c_oct=$c_nov=$c_dec=0;

if (!empty($graphData)) {
  foreach ($graphData as $key => $graphVal) {
    if ($graphVal->role_id==5) {
      if ($graphVal->month==1) {
        $c_jan = $graphVal->count;
      } elseif ($graphVal->month==2) {
        $c_feb = $graphVal->count;
      } elseif ($graphVal->month==3) {
        $c_mar = $graphVal->count;
      } elseif ($graphVal->month==4) {
        $c_apr = $graphVal->count;
      } elseif ($graphVal->month==5) {
        $c_may = $graphVal->count;
      } elseif ($graphVal->month==6) {
        $c_jun = $graphVal->count;
      } elseif ($graphVal->month==7) {
        $c_jul = $graphVal->count;
      } elseif ($graphVal->month==8) {
        $c_aug = $graphVal->count;
      } elseif ($graphVal->month==9) {
        $c_sep = $graphVal->count;
      } elseif ($graphVal->month==10) {
        $c_oct = $graphVal->count;
      } elseif ($graphVal->month==11) {
        $c_nov = $graphVal->count;
      } elseif ($graphVal->month==12) {
        $c_dec = $graphVal->count;
      }
    } elseif ($graphVal->role_id==6) {
      if ($graphVal->month==1) {
        $d_jan = $graphVal->count;
      } elseif ($graphVal->month==2) {
        $d_feb = $graphVal->count;
      } elseif ($graphVal->month==3) {
        $d_mar = $graphVal->count;
      } elseif ($graphVal->month==4) {
        $d_apr = $graphVal->count;
      } elseif ($graphVal->month==5) {
        $d_may = $graphVal->count;
      } elseif ($graphVal->month==6) {
        $d_jun = $graphVal->count;
      } elseif ($graphVal->month==7) {
        $d_jul = $graphVal->count;
      } elseif ($graphVal->month==8) {
        $d_aug = $graphVal->count;
      } elseif ($graphVal->month==9) {
        $d_sep = $graphVal->count;
      } elseif ($graphVal->month==10) {
        $d_oct = $graphVal->count;
      } elseif ($graphVal->month==11) {
        $d_nov = $graphVal->count;
      } elseif ($graphVal->month==12) {
        $d_dec = $graphVal->count;
      }
    }
  }
}
?>
<?php $this->start('bottom-script'); ?>
<script>
  $(function () {

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
      {
        label               : 'Drivers',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [<?=$d_jan?>,<?=$d_feb?>,<?=$d_mar?>,<?=$d_apr?>,<?=$d_may?>,<?=$d_jun?>,<?=$d_jul?>,<?=$d_aug?>,<?=$d_sep?>,<?=$d_oct?>,<?=$d_nov?>,<?=$d_dec?>]
      },
      {
        label               : 'Clients',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [<?=$c_jan?>,<?=$c_feb?>,<?=$c_mar?>,<?=$c_apr?>,<?=$c_may?>,<?=$c_jun?>,<?=$c_jul?>,<?=$c_aug?>,<?=$c_sep?>,<?=$c_oct?>,<?=$c_nov?>,<?=$c_dec?>]
      }
      ]
    }


    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>
<?php  $this->end(); ?>
<style>
  .box-header {
    margin-bottom: 0;
  }
  span.info-box-text {
    white-space: normal;
}
</style>