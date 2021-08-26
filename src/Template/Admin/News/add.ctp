<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \December 27, 2018, 11:25 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News $news
 */
$this->assign('title',__('Add New News'));
$this->Breadcrumbs->add(__('News'),['action'=>'index']);
$this->Breadcrumbs->add(__('Add New News'));
$userId  = $this->request->getSession()->read('Auth.User.id');
?>

  <!-- Main content -->
  <section class="content news add form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <?= $this->Flash->render() ; ?>
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
            <?= __('News') ?>
            <small><?= __('Add New News') ?></small>
          </h3>
          <div class="box-tools pull-right">
              <?=$this->Html->link(
                '<i class="fa fa-arrow-circle-left"></i>',
                ['action' => 'index'],
                ['class' => 'btn btn-info btn-xs','title' => __('Back to News'),'escape' => false]
              );?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php
            echo $this->Form->create($news,['id' => 'news-add-frm','type'=>'file']); ?>
            <div class="box-body">
              <ul class="nav nav-tabs" id="newsTab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active" data-toggle="tab" href="#default-tab" role="tab" aria-controls="nav-default" aria-selected="true"><?=__("Default");?></a>
                </li>
                <?php
                if ($newsLanguages !== false) {
                  foreach ($newsLanguages as $newsLanguage) {
                    if ($newsLanguage['id'] != SYSTEM_LANGUAGE_ID && $newsLanguage['status'] == 1) {?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#<?=$newsLanguage['culture'];?>-tab" role="tab" aria-controls="nav-<?=$newsLanguage['culture'];?>" aria-selected="true"><?=__($newsLanguage['name']);?></a>
                        <?=$this->Form->control('news_translations.' . $newsLanguage['id'] . '.language_id', ['type' => 'hidden', 'value' => $newsLanguage['id']]);?>
                        <?=$this->Form->control('news_translations.' . $newsLanguage['id'] . '.culture', ['type' => 'hidden', 'value' => $newsLanguage['culture']]);?>
                      </li>
                    <?php }
                  }
                }?>
              </ul>
              <div class="tab-content" id="newsTabContent">
                <div class="tab-pane fade active in" id="default-tab" role="tabpanel" aria-labelledby="nav-default-tab">
                  <?php
                  echo $this->Form->control('title', ['type' => 'text']);
                  echo $this->Form->control('content',['class'=>'ckeditor']);
                  echo $this->Form->control('excerpt');
                  echo $this->Form->control('news_url', ['type' => 'text']); ?>
                </div>
                <?php
                  if ($newsLanguages !== false) {
                    foreach ($newsLanguages as $newsLanguage) {
                      if ($newsLanguage['id'] != SYSTEM_LANGUAGE_ID && $newsLanguage['status'] == 1) {?>
                        <div class="tab-pane fade" id="<?=$newsLanguage['culture'];?>-tab" role="tabpanel" aria-labelledby="nav-<?=$newsLanguage['culture'];?>-tab">
                          <?=$this->Form->control('news_translations.' . $newsLanguage['id'] . '.id', ['type' => 'hidden']);?>
                          <?=$this->Form->control('news_translations.' . $newsLanguage['id'] . '.title', ['type' => 'text', 'dir' => $newsLanguage['direction']]);?>
                          <?=$this->Form->control('news_translations.' . $newsLanguage['id'] . '.content', ['class' => 'ckeditor', 'dir' => $newsLanguage['direction']]);?>
                          <?=$this->Form->control('news_translations.' . $newsLanguage['id'] . '.excerpt', ['dir' => $newsLanguage['direction']]);?>
                          <?=$this->Form->control('news_translations.' . $newsLanguage['id'] . '.news_url', ['type' => 'text', 'dir' => $newsLanguage['direction']]);?>
                        </div>
                      <?php }
                    }
                  } ?>
              </div>
              <?=$this->Form->control('cloud_tags',['type' => 'text','data-role'=>'tagsinput']);?>
              <?=$this->Form->control('meta_title');?>
              <?=$this->Form->control('meta_keywords');?>
              <?=$this->Form->control('meta_description');?>
              <input type="hidden" name="user_id" value="<?=$userId?>">
              <div class="row">
                <div class="col-md-6">
                  <?= $this->Form->control('display_date');?>
                </div>
                <div class="col-md-6">
                  <?= $this->Form->control('sort_order',['templates' => ['inputContainer' => '<div class="form-inline">{{content}}</div>']]);?>
                </div>
              </div>
                <?php
                echo $this->Form->control('header_image',['type'=>'file','accept'=>'image/*', 'onchange'=>'return imageFileValidation(this)']);

                echo $this->Form->control('custom_link'); ?>
                <div class="row">
                  <div class="col-md-6 fg-margin">
                    <?= $this->Form->control('upload_document_1',['type'=>'file', 'onchange'=>'return otherFileValidation(this)']); ?>
                    <p class="help-block">Allowed File : jpeg, jpg, png, gif ,pdf, doc, docx, xls and xlsx</p>
                  </div>
                  <div class="col-md-6 fg-margin">
                    <?= $this->Form->control('upload_document_2',['type'=>'file', 'onchange'=>'return otherFileValidation(this)']); ?>
                    <p class="help-block">Allowed File : jpeg, jpg, png, gif ,pdf, doc, docx, xls and xlsx</p>
                  </div>
                </div>
                <?php
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
  </section>

<?php $this->Html->script(['AdminLTE./plugins/ckeditor/ckeditor'],['block' => 'bottom-script']); ?>
<?php $this->append('bottom-script');?>
<script>
(function($){
    $(document).ready(function(){
      $('#display-date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
      })
        if(typeof $.validator !== "undefined"){
            $("#news-add-frm").validate();
        }
    });
})($);

function otherFileValidation(fileInput){
  var filePath = fileInput.value;
  var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.doc|\.docx|\.pdf|\.xls|\.xlsx)$/i;
  var invalidfile = filePath.match(/\./g).length;
  if (invalidfile>1) {
    alert("Invalid File. e.g. double dot.");
    fileInput.value = '';
    return false;
  }else if(!allowedExtensions.exec(filePath)){
    alert("Please upload file having extensions .jpeg/.jpg/.png/.gif/.doc/.docx/.pdf/.xls/.xlsx only.");
    fileInput.value = '';
    return false;
  }
}

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