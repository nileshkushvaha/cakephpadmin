<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \November 23, 2018, 11:41 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Banner $banner
 */
$this->assign('title',__('Add New Banner'));
$this->Breadcrumbs->add(__('Banners'),['action'=>'index']);
$this->Breadcrumbs->add(__('Add New Banner'));
$userId  = $this->request->getSession()->read('Auth.User.id');
?>

  <!-- Main content -->
  <section class="content banner add form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
              <?= __('Banner') ?>
              <small><?= __('Add New Banner') ?></small>
            </h3>
            <div class="box-tools pull-right">
                <?=$this->Html->link(
                  '<i class="fa fa-arrow-circle-left"></i>',
                  ['action' => 'index'],
                  ['class' => 'btn btn-info btn-xs','title' => __('Back to Banners'),'escape' => false]
                );?>
              </div>
            </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php
              echo $this->Form->create($banner,['id' => 'banner-add-frm','type'=>'file']); ?>
              <div class="box-body">
              <?php
                echo $this->Form->control('title');
                echo $this->Form->control('banner_category_id');
                echo $this->Form->control('excerpt');
                echo $this->Form->control('banner_type', ['options' => ['image'=>'image','video'=>'video']]);
              ?>
              <div class="mt-call mt-image fg-margin">
                <?= $this->Form->control('banner_image',['type'=>'file','accept'=>'image/*', 'onchange'=>'return imageFileValidation(this)']);?>
                <p class="help-block">Allowed File : jpeg, jpg, png and gif</p>
              </div>
              <div class="mt-call mt-video fg-margin">
                <?= $this->Form->control('banner_video',['type'=>'file','accept'=>'video/*','onchange'=>'return videoFileValidation(this)']);?>
                <p class="help-block">Allowed File : mp4, ogg, 3gp and mov</p>
              </div>
            <input type="hidden" name="user_id" value="<?=$userArray['id']?>">
    <div class="box-footer">
      <?php 
      if ($userArray['role_id'] == 4) {
        echo $this->Form->button(__('Save as Draft'),['class' => 'btn btn-primary','name'=>'draft','value'=>2]);
        echo $this->Form->button(__('Send for editor'),['class' => 'btn btn-primary mx-1','name'=>'editor','value'=>3]);
      }elseif ($userArray['role_id'] == 3) {
        echo $this->Form->button(__('Publish'),['class' => 'btn btn-primary','name'=>'draft','value'=>1]);
        echo $this->Form->button(__('Send to manager'),['class' => 'btn btn-primary mx-1','name'=>'editor','value'=>4]);
        echo $this->Form->button(__('Send to Author'),['class' => 'btn btn-primary mx-1','name'=>'editor','value'=>2]);
      }elseif ($userArray['role_id'] == 2) {
        echo $this->Form->button(__('Publish'),['class' => 'btn btn-primary','name'=>'draft','value'=>1]);
        echo $this->Form->button(__('Send to editor'),['class' => 'btn btn-primary mx-1','name'=>'editor','value'=>3]);
      }elseif ($userArray['role_id'] == 1) {
        echo $this->Form->button(__('Publish'),['class' => 'btn btn-primary','name'=>'draft','value'=>1]);
        echo $this->Form->button(__('Save as Draft'),['class' => 'btn btn-primary mx-1','name'=>'draft','value'=>2]);
      }
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
    $('#banner-type').on('change',function(){
      var $menu_type = $(this).val();
      $('.mt-call').hide();
      $('.mt-call input, .mt-call select').attr('disabled','disabled');
      $('.mt-' + $menu_type).show();
      $('.mt-' + $menu_type + ' input, .mt-' + $menu_type + ' select').removeAttr('disabled','disabled');
    }).change();
    if(typeof $.validator !== "undefined"){
      $("#banner-add-frm").validate();
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

function videoFileValidation(fileInput){
  var filePath = fileInput.value;
  var allowedExtensions = /(\.mp4|\.ogg|\.3gp|\.mov)$/i;
  var invalidfile = filePath.match(/\./g).length;
  if (invalidfile>1) {
    alert("Invalid File. e.g. double dot.");
    fileInput.value = '';
    return false;
  }else if(!allowedExtensions.exec(filePath)){
    alert('Please upload file having extensions .mp4/.ogg/.3gp/.mov only.');
    fileInput.value = '';
    return false;
  }
}
</script>
<?php $this->end(); ?>