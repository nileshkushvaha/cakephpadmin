<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:12 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
$this->assign('title',__('Edit State ( ' . $state->name .' ) '));
$this->Breadcrumbs->add(__('States'),['action'=>'index']);
$this->Breadcrumbs->add(__('Edit State ( ' . $state->name .' ) '));
?>

  <!-- Main content -->
  <section class="content state edit form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
            <?= __('State') ?>
                          <small><?= __('Edit State  ( ' . $state->name .' ) ') ?></small>
          </h3>
          <div class="box-tools pull-right">
              <?=$this->Html->link(
                      '<i class="fa fa-arrow-circle-left"></i>',
                      ['action' => 'index'],
                      ['class' => 'btn btn-info btn-xs','title' => __('Back to States'),'escape' => false]
                  );?>
                    <?= $this->Form->postLink(
                      '<i class="fa fa-trash-o"></i>',
                      ['action' => 'delete', $state->id],
                      ['confirm' => __('Are you sure you want to delete this State?', $state->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                  )?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php
              echo $this->Form->create($state,['id' => 'state-edit-frm']); ?>
              <div class="box-body">
              <?php
                echo $this->Form->control('code');
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
            $("#state-edit-frm").validate();
        }
    });
})($);
</script>
<?php $this->end(); ?>