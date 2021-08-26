<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:12 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District $district
 */
$this->assign('title',__('Add New District'));
$this->Breadcrumbs->add(__('Districts'),['action'=>'index']);
$this->Breadcrumbs->add(__('Add New District'));
?>

  <!-- Main content -->
  <section class="content district add form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
            <?= __('District') ?>
                          <small><?= __('Add New District') ?></small>
          </h3>
          <div class="box-tools pull-right">
              <?=$this->Html->link(
                      '<i class="fa fa-arrow-circle-left"></i>',
                      ['action' => 'index'],
                      ['class' => 'btn btn-info btn-xs','title' => __('Back to Districts'),'escape' => false]
                  );?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php
              echo $this->Form->create($district,['id' => 'district-add-frm']); ?>
              <div class="box-body">
              <?php
                echo $this->Form->control('state_id', ['options' => $states]);
              echo $this->Form->control('name');
              echo $this->Form->control('flag');
 ?>
    <div class="box-footer">
      <?php 
      echo $this->Form->button(__('Submit'),['class' => 'btn btn-primary']);
      echo $this->Html->link(__('Cancel'),['action' => 'index'],['class' => 'btn btn-danger mx-1']); ?>
    </div>
      <?php echo $this->Form->end();?>
    </div>
      </div>
    </div>
  </section>
<?php $this->append('bottom-script');?>
<script>
(function($){
    $(document).ready(function(){
        if(typeof $.validator !== "undefined"){
            $("#district-add-frm").validate();
        }
    });
})($);
</script>
<?php $this->end(); ?>