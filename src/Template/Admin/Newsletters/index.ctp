<?php
$this->assign('title',__('Newsletters'));
$this->Breadcrumbs->add(__('Newsletters'));
$email = isset($email)?$email:'';
$fromdate = isset($fromdate)?$fromdate:'';
$todate = isset($todate)?$todate:'';
$selectedLen = isset($selectedLen)?$selectedLen:'';
?>
  <!-- Main content -->
  <section class="content product index">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <div class="box box-primary">
          <div class="box-header">
              <h3 class="box-title"><?= __('Search - Newsletters'); ?></h3>
          </div> 
          <?= $this->Form->create('searchNewsletters',['id' =>'searchNewsletters','type'=>'get']); ?>
            <div class="box-body table-responsive">
              <?= $this->element('errorlist'); ?> 
              <div class="row1">
                <div class="col-md-1"></div>
                <div class="col-md-2"><label for="email">Email Id</label></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="text" name="email" id="email" maxlength="40" placeholder="Enter email Id" class="form-control" value="<?=$email?>">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="clearfix"></div>
              <div class="row2">
                <div class="col-md-1"></div>
                <div class="col-md-2"><label for="fromdate">From Date</label></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="text" autocomplete="off" name="fromdate" id="fromdate" placeholder="Select from date" class="form-control" value="<?=$fromdate?>">
                  </div>
                </div>
                <div class="col-md-1"><label for="todate">To Date</label></div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" autocomplete="off" name="todate" id="todate" placeholder="Select to date" class="form-control" value="<?=$todate?>">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row3">
                <div class="col-md-5"></div>
                <div class="col-md-1"><button name="search_button" value="search_button" type="submit" class="btn btn-primary btn-green">Search</button></div>
                <div class="col-md-1">
                  <?php if(empty($email)){ ?>
                    <button type="reset" class="btn btn-danger">Reset</button>                  
                  <?php } else { ?>
                    <?= $this->Html->link(__('Reset'),['controller'=>'Newsletters','action'=>'index'],['class'=>'btn btn-danger']); ?>
                  <?php }?>
                </div>
              </div>
              <div class="clearfix"></div>
          </div>
          <?= $this->Form->end(); ?>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <?= $this->Form->create('page_number',['id'=>'enquiry_list','type'=>'get','class'=>'form-inline']); ?>
            <div class="box-header">
              <div class="box-title">
                <div class="form-group">
                <label for="page_length">Display:</label>
                <?php $page_length = array('10'=>'10','20'=>'20','50'=>'50','100'=>'100','200'=>'200','all'=>'All'); ?>
                  <select class="form-control" name="page_length" id="page_length">
                    <?= $this->OptionsData->list_toOption($page_length, $selectedLen)?>
                  </select>
                  <input type="hidden" name="email" value="<?=@$email?>">
                  <input type="hidden" name="category_id" value="<?=@$category_id?>">
                  <input type="hidden" name="fromdate" value="<?=@$fromdate?>">
                  <input type="hidden" name="todate" value="<?=@$todate?>">
                </div>
              </div>
              <div class="box-tools">
                <button name="export_excel" value="export_excel" class="mt4px btn btn-primary btn-green">Export to Excel</button>
              </div>
            </div>
          <?= $this->Form->end()?>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('category_id','Category') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th width="100" scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php 

                $paginatorInformation = $this->Paginator->params();
                $pageOffset=($paginatorInformation['page']-1);
                $perPage = $paginatorInformation['perPage'];
                $counter = ($pageOffset*$perPage);
                $i = 1;
                foreach ($newsletters as $newsletter): ?>
                  <tr>
                    <td><?= $this->Number->format($i+$counter) ?></td>
                    <td><?= h($newsletter->email) ?></td>
                    <td>
                      <?php
                        $category = "Crisidex";
                        if($newsletter->category_id=='3'){
                          $category = "MSME Pulse";
                        }
                        echo $category;
                      ?>
                    </td>
                    <td><?= date('Y-m-d H:i A',strtotime($newsletter->created)) ?></td>
                    <td class="actions">
                      <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $newsletter->id],['class' => 'btn btn-info btn-xs', 'title' => __('View'), 'escape' => false]) ?>
                      <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $newsletter->id], ['confirm' => __('Are you sure you want to delete this data?', $newsletter->id),'class' => 'btn btn-danger btn-xs', 'title' => __('Delete'), 'escape' => false]) ?>
                    </td>
                  </tr>
                  <?php $i++;
                  endforeach; ?>
                  <?php if(count($newsletters) == 0):?>
                  <tr>
                      <td colspan="14"><?= __('Record not found!'); ?></td>
                  </tr>
                  <?php endif;?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <?= $this->Paginator->first('<<') ?>
              <?= $this->Paginator->prev('<') ?>
              <?= $this->Paginator->numbers() ?>
              <?= $this->Paginator->next('>') ?>
              <?= $this->Paginator->last('>>') ?>
            </ul>
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
  
<?php $this->Html->script(['../assets/js/jquery-ui.min'],['block' => 'bottom-script']); ?>
<?php $this->Html->css(['../assets/css/jquery-ui.min'], ['block' => 'head-style']);?>
  <?php $this->append('bottom-script');?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#page_length').on('change',function () {
        $('#enquiry_list').submit();
      })
    });

  $("#searchNewsletters").validate({
    rules:{
      fromdate:{
        required:false,
        customDateValidator: true
      },
      todate:{
        required:false,
        customDateValidator: true
      }
    },
    messages:{
      fromdate: {
        customDateValidator: "Allowed date format is dd-mm-yyyy.",
      },
      todate: {
        customDateValidator: "Allowed date format is dd-mm-yyyy.",
      }
    }
  });

  $('#reset').on('click', function () {
    validator.resetForm();
    validator.reset();
  });

  jQuery.validator.addMethod("customDateValidator", function(value, element) { 
    // dd-mm-yyyy
    var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/ ;
    if (value != '') {
      if (! re.test(value) ) return false
      try{jQuery.datepicker.parseDate( 'dd-mm-yy', value);return true ;}
        catch(e){return false;} 
    } 
    return true;
    },
    "Please enter a valid date format dd-mm-yyyy"
  );

  $( function() {
    var dateFormat = "dd-mm-yy",
    from = $( "#fromdate" )
      .datepicker({
        defaultDate: "+1w",
        dateFormat : 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        maxDate: '0',
        showOn: "button",
        buttonImage: "<?php echo $this->Url->build('/images/calender.png')?>",
        buttonText: "",
        prevText : "",
        nextText : "",
      })
      .on( "change", function() {
        to.datepicker( "option", "minDate", getDate( this ) );
        $(".ui-datepicker-trigger").addClass("calender-pd");
      }),
    to = $( "#todate" ).datepicker({
      defaultDate: "+1w",
      dateFormat : 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      maxDate: '0',
      showOn: "button",
      buttonImage: "<?php echo $this->Url->build('/images/calender.png')?>",
      buttonText: "",
      prevText : "",
      nextText : "",
    })
    .on( "change", function() {
      from.datepicker( "option", "maxDate", getDate( this ) );
      $(".ui-datepicker-trigger").addClass("calender-pd");
    });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }
    $(".ui-datepicker-trigger").addClass("calender-pd");
  });

  </script>
  <?php $this->end(); ?>