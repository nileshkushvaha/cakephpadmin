<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \June 27, 2020, 10:14 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Team $team
 */
$this->assign('title',__('Add New Team'));
$this->Breadcrumbs->add(__('Teams'),['action'=>'index']);
$this->Breadcrumbs->add(__('Add New Team'));
$userId  = $this->request->getSession()->read('Auth.User.id');
?>

  <!-- Main content -->
  <section class="content team add form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
              <?= __('Team') ?> <small><?= __('Add New Team') ?></small>
            </h3>
            <div class="box-tools pull-right">
              <?=$this->Html->link(
                '<i class="fa fa-arrow-circle-left"></i>',
                ['action' => 'index'],
                ['class' => 'btn btn-info btn-xs','title' => __('Back to Teams'),'escape' => false]
                );?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?= $this->Form->create($team,['id'=>'team-add-frm','type'=>'file']); ?>
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
              <input type="hidden" name="user_id" value="<?=$userId?>">
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
            $("#team-add-frm").validate();
        }
    });
})($);
</script>
<?php $this->end(); ?>