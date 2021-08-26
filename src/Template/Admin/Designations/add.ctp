<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:07 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Designation $designation
 */
$this->assign('title',__('Add New Designation'));
$this->Breadcrumbs->add(__('Designations'), ['action' => 'index']);
$this->Breadcrumbs->add(__('Add New Designation'));
?>

  <!-- Main content -->
  <section class="content designation add form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
            <?= __('Designation') ?>
                          <small><?= __('Add New Designation') ?></small>
          </h3>
          <div class="box-tools pull-right">
              <?=$this->Html->link(
                      '<i class="fa fa-arrow-circle-left"></i>',
                      ['action' => 'index'],
                      ['class' => 'btn btn-info btn-xs','title' => __('Back to Designations'),'escape' => false]
                  );?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php
              echo $this->Form->create($designation,['id' => 'designation-add-frm']); ?>
              <div class="box-body">
              <?php
                echo $this->Form->control('department_id', ['options' => $departments]);
              echo $this->Form->control('name');
              echo $this->Form->control('status');
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
            $("#designation-add-frm").validate();
        }
    });
})($);
</script>
<?php $this->end(); ?>