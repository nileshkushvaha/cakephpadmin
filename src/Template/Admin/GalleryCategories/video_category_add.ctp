<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \February 2, 2019, 11:47 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GalleryCategory $galleryCategory
 */
$this->assign('title',__('Add New Video Gallery Category'));
$this->Breadcrumbs->add(__('Video Gallery Categories'),['action'=>'index']);
$this->Breadcrumbs->add(__('Add New Video Gallery Category'));
$userId  = $this->request->getSession()->read('Auth.User.id');
?>

  <!-- Main content -->
  <section class="content galleryCategory add form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
              <?= __('Video Gallery Category') ?>
              <small><?= __('Add New Video Gallery Category') ?></small>
            </h3>
            <div class="box-tools pull-right">
              <?=$this->Html->link(
                '<i class="fa fa-arrow-circle-left"></i>',
                ['action' => 'index'],
                ['class' => 'btn btn-info btn-xs','title' => __('Back to Video Gallery Categories'),'escape' => false]
              );?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?= $this->Form->create($galleryCategory,['id' => 'videoGalleryCategory-add-frm']); ?>
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
              <input type="hidden" name="user_id" value="<?=$userId?>">
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
            $("#galleryCategory-add-frm").validate();
        }
    });
})($);
</script>
<?php $this->end(); ?>