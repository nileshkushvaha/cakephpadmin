<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \June 27, 2020, 10:14 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Team $team
 */
$this->assign('title',__('Edit Team ( ' . $team->name .' ) '));
$this->Breadcrumbs->add(__('Teams'),['action'=>'index']);
$this->Breadcrumbs->add(__('Edit Team ( ' . $team->name .' ) '));
?>

<!-- Main content -->
<section class="content team edit form">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">
            <?= __('Team') ?>
            <small><?= __('Edit Team  ( ' . $team->name .' ) ') ?></small>
          </h3>
          <div class="box-tools pull-right">
            <?=$this->Html->link(
              '<i class="fa fa-arrow-circle-left"></i>',
              ['action' => 'index'],
              ['class' => 'btn btn-info btn-xs','title' => __('Back to Teams'),'escape' => false]
            );?>
            <?= $this->Form->postLink(
              '<i class="fa fa-trash-o"></i>',
              ['action' => 'delete', $team->id],
              ['confirm' => __('Are you sure you want to delete this Team?', $team->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
            )?>
          </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($team,['id'=>'team-edit-frm','type'=>'file']); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <?= $this->Form->control('name'); ?>
            </div>
            <div class="col-md-6"> 
              <?= $this->Form->control('designation');?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <?= $this->Form->control('content');?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <?= $this->Form->control('profile_photo',['type'=>'file']); ?>
              <input type="hidden" name="old_profile_photo" value="<?=$team->profile_photo?>">
            </div>
            <div class="col-md-6"> 
              <?= $this->Form->control('facebook_url');?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <?= $this->Form->control('linkedin_url'); ?>
            </div>
            <div class="col-md-6"> 
              <?= $this->Form->control('twitter_url');?>
            </div>
          </div>
          <?= $this->Form->control('status'); ?>
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
        $("#team-edit-frm").validate();
      }
    });
  })($);
</script>
<?php $this->end(); ?>