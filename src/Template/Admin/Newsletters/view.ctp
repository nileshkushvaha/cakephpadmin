<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \January 2, 2019, 11:15 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OnlineEnquiry $onlineEnquiry
 */
$this->assign('title',__('Newsletters ( ' . $newsletter->email . ' ) '));
$this->Breadcrumbs->add(__('Newsletters'),['action'=>'index']);
$this->Breadcrumbs->add(__('Newsletters ( ' . $newsletter->email . ' ) '));
?>

  <!-- Main content -->
  <section class="content newsletter view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('newsletter ( ' . $newsletter->email . ' ) ') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to Newsletter'),'escape' => false]
                  );?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                 <dl class="dl-horizontal">
              <dt><?= __('Email') ?></dt>
              <dd><?= h($newsletter->email) ?></dd>
              <dt><?= __('Category') ?></dt>
              <dd>
                 <?php
                  $category = "Crisidex";
                  if($newsletter->category_id=='3'){
                     $category = "MSME Pulse";
                  }
                  echo $category;
                 ?>
              </dd>
              <dt><?= __('Status') ?></dt>
              <dd>
                  <?php
                     $status = "Active";
                     if($newsletter->status==0){
                        $status = "In-active";
                     }
                     echo $status;
                  ?>
               </dd>
              <dt><?= __('Subscribe') ?></dt>
              <dd>
                  <?php
                     $subscibe = "Subscribed";
                     if($newsletter->is_unsubscribe==1){
                        $subscibe = "Un-Subscribed";
                     }
                     echo $subscibe;
                  ?>
               </dd>
              <dt><?= __('Reason') ?></dt>
              <dd><?= h($newsletter->reason)?></dd>
              <dt><?= __('Date & Time') ?></dt>
              <dd><?= date('Y-m-d H:i A',strtotime($newsletter->created)) ?></dd>
          </dl>
              </div>
              <!-- /.box-body -->
           </div>
           <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
    <!-- div -->
 </section>