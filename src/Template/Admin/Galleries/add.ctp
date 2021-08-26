<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \February 2, 2019, 11:48 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gallery $gallery
 */
$this->assign('title',__('Add New Gallery'));
$this->Breadcrumbs->add(__('Galleries'),['action'=>'index']);
$this->Breadcrumbs->add(__('Add New Gallery'));
?>

  <!-- Main content -->
  <section class="content gallery add form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
            <?= __('Gallery') ?>
              <small><?= __('Add New Gallery') ?></small>
          </h3>
          <div class="box-tools pull-right">
              <?=$this->Html->link(
                '<i class="fa fa-arrow-circle-left"></i>',
                ['action' => 'index'],
                ['class' => 'btn btn-info btn-xs','title' => __('Back to Galleries'),'escape' => false]
              );?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?= $this->Form->create($gallery,['id' => 'gallery-add-frm','type'=>'file']); ?>
            <div class="box-body">
              <?= $this->Form->control('gallery_category_id', ['options' => $galleryCategories]);
              echo $this->Form->control('filename',['type'=>'file', 'accept'=>'image/*', 'onchange'=>'return imageFileValidation(this)']); ?>
              <p class="help-block">Allowed File : jpeg, jpg, png and gif</p>
            <?php
                echo $this->Form->control('title');
              echo $this->Form->control('sort_order');
              echo $this->Form->control('description');
              echo $this->Form->control('cloud_tags',['type' => 'text','data-role'=>'tagsinput']);
              echo $this->Form->control('is_home');
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
      $("#gallery-add-frm").validate();
    }
  });
})($);

function imageFileValidation(fileInput){
  var filePath = fileInput.value;
  var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
  var invalidfile = filePath.match(/\./g).length;
  if (invalidfile>1) {
    alert("Invalid File. e.g. double dot.");
    fileInput.value = '';
    return false;
  }else if(!allowedExtensions.exec(filePath)){
    alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
    fileInput.value = '';
    return false;
  }
}
</script>
<?php $this->end(); ?>