<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \February 2, 2019, 11:47 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GalleryCategory $galleryCategory
 */
$this->assign('title',__('Edit Photo Gallery Category ( ' . $galleryCategory->title .' ) '));
$this->Breadcrumbs->add(__('Photo Gallery Categories'),['action'=>'index']);
$this->Breadcrumbs->add(__('Edit Photo Gallery Category ( ' . $galleryCategory->title .' ) '));
?>
  <!-- Main content -->
  <section class="content galleryCategory edit form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
              <?= __('Gallery Category') ?>
                <small><?= __('Edit Photo Gallery Category  ( ' . $galleryCategory->title .' ) ') ?></small>
            </h3>
            <div class="box-tools pull-right">
              <?=$this->Html->link(
                '<i class="fa fa-arrow-circle-left"></i>',
                ['action' => 'index'],
                ['class' => 'btn btn-info btn-xs','title' => __('Back to Photo Gallery Categories'),'escape' => false]
              );?>
              <?= $this->Form->postLink(
                '<i class="fa fa-trash-o"></i>',
                ['action' => 'delete', $galleryCategory->id],
                ['confirm' => __('Are you sure you want to delete this Photo Gallery Category?', $galleryCategory->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
              )?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?= $this->Form->create($galleryCategory,['id' => 'galleryCategory-edit-frm']); ?>
            <div class="box-body">
              <?php
                //echo $this->Form->control('article_id', ['options' => $articles, 'empty' =>'--Select--']);
              echo $this->Form->control('title');
              echo $this->Form->control('content');
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
      $("#galleryCategory-edit-frm").validate();
    }
  });
})($);
</script>
<?php $this->end(); ?>