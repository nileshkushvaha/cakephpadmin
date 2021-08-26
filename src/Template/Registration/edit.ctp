<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 31, 2018, 6:16 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration $registration
 */
$this->assign('title',__('Edit Registration ( ' . $registration->name .' ) '));
$this->Html->addCrumb(__('Registration'),['action'=>'index']);
$this->Html->addCrumb(__('Edit Registration ( ' . $registration->name .' ) '));
?>

  <!-- Main content -->
  <section class="content registration edit form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
            <?= __('Registration') ?>
                          <small><?= __('Edit Registration  ( ' . $registration->name .' ) ') ?></small>
          </h3>
          <div class="box-tools pull-right">
              <?=$this->Html->link(
                      '<i class="fa fa-arrow-circle-left"></i>',
                      ['action' => 'index'],
                      ['class' => 'btn btn-info btn-xs','title' => __('Back to Registration'),'escape' => false]
                  );?>
                    <?= $this->Form->postLink(
                      '<i class="fa fa-trash-o"></i>',
                      ['action' => 'delete', $registration->id],
                      ['confirm' => __('Are you sure you want to delete this Registration?', $registration->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                  )?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php
              echo $this->Form->create($registration,['id' => 'registration-edit-frm']); ?>
              <div class="box-body">
              <?php
                echo $this->Form->control('user_id', ['options' => $users]);
              echo $this->Form->control('designation_id', ['options' => $designations, 'empty' => true]);
              echo $this->Form->control('date_of_birth', ['empty' => true]);
              echo $this->Form->control('shortname');
              echo $this->Form->control('name');
              echo $this->Form->control('gender');
              echo $this->Form->control('email');
              echo $this->Form->control('mobile');
              echo $this->Form->control('phone');
              echo $this->Form->control('fax');
              echo $this->Form->control('state_id', ['options' => $states]);
              echo $this->Form->control('district_id', ['options' => $districts]);
              echo $this->Form->control('city_id');
              echo $this->Form->control('address');
              echo $this->Form->control('pincode');
              echo $this->Form->control('star');
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
            $("#registration-edit-frm").validate();
        }
    });
})($);
</script>
<?php $this->end(); ?>