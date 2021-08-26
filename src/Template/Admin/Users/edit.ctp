<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:05 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->assign('title',__('Edit User ( ' . $user->name .' ) '));
$this->Breadcrumbs->add(__('Users'),['action'=>'index']);
$this->Breadcrumbs->add(__('Edit User ( ' . $user->name .' ) '));
?>

<!-- Main content -->
<section class="content user edit form">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">
            <?= __('User') ?>
            <small><?= __('Edit User  ( ' . $user->name .' ) ') ?></small>
          </h3>
          <div class="box-tools pull-right">
            <?=$this->Html->link(
              '<i class="fa fa-arrow-circle-left"></i>',
              ['action' => 'index'],
              ['class' => 'btn btn-info btn-xs','title' => __('Back to Users'),'escape' => false]
            );?>
          </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
        echo $this->Form->create($user,['id' => 'user-edit-frm']); ?>
        <div class="box-body">
          <?php
          echo $this->Form->control('name');
          echo $this->Form->control('username');
          echo $this->Form->control('email');
              //echo $this->Form->control('password');
          echo $this->Form->control('role_id', ['options' => $roles]);
          echo $this->Form->control('status');
          ?>
        </div>
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
        $("#user-edit-frm").validate();
      }
    });
  })($);
</script>
<?php $this->end(); ?>