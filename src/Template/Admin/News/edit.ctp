<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \December 27, 2018, 11:25 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News $news
 */
$this->assign('title',__('Edit News ( ' . $news->title .' ) '));
$this->Breadcrumbs->add(__('News'),['action'=>'index']);
$this->Breadcrumbs->add(__('Edit News'));
?>

  <!-- Main content -->
  <section class="content news edit form">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
            <?= __('News') ?>
              <small><?= __('Edit News') ?></small>
          </h3>
          <div class="box-tools pull-right">
              <?=$this->Html->link(
                '<i class="fa fa-arrow-circle-left"></i>',
                ['action' => 'index'],
                ['class' => 'btn btn-info btn-xs','title' => __('Back to News'),'escape' => false]
              );?>
              <?= $this->Form->postLink(
                '<i class="fa fa-trash-o"></i>',
                ['action' => 'delete', $news->id],
                ['confirm' => __('Are you sure you want to delete this News?', $news->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
              )?>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php
            echo $this->Form->create($news,['id' => 'news-edit-frm','type'=>'file']); ?>
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
              <div class="row">
                <div class="col-md-6">
                  <?= $this->Form->control('display_date');?>
                </div>
                <div class="col-md-6">
                  <?= $this->Form->control('sort_order',['templates' => ['inputContainer' => '<div class="form-inline">{{content}}</div>']]);?>
                </div>
              </div>
              <?= $this->Form->control('custom_link'); ?>
              <div class="input-area file">
                <div class="form-group">
                  <label for="header-image">Header Image <?php if ($news->header_image) { ?><a title="View" target="_blank" href="<?= $this->Url->build('/files/news/'. $news->header_image);?>"><?=$news->header_image?></a> <?php } ?></label>
                  <input type="file" name="header_image" accept="image/*" id="header-image" class="form-control" onchange="return imageFileValidation(this)">
                  <input type="hidden" name="old_header_image" value="<?=$news->header_image?>">
                  <p class="help-block">Allowed File : jpeg, jpg, png and gif</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="input-area file">
                    <div class="form-group">
                      <label for="upload-document-1">Upload Document 1 <a title="View" target="_blank" href="<?= $this->Url->build('/files/news/'. $news->upload_document_1);?>"><?=$news->upload_document_1?></a></label>
                      <input type="file" name="upload_document_1" accept="application/pdf" id="upload-document-1" class="form-control" onchange="return otherFileValidation(this)">
                      <input type="hidden" name="old_upload_document_1" value="<?=$news->upload_document_1?>">
                      <p class="help-block">Allowed File : jpeg, jpg, png, gif ,pdf, doc, docx, xls and xlsx</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-area file">
                    <div class="form-group">
                      <label for="upload-document-2">Upload Document 2 <a title="View" target="_blank" href="<?= $this->Url->build('/files/news/'. $news->upload_document_2);?>"><?=$news->upload_document_2?></a></label>
                      <input type="file" name="upload_document_2" accept="application/pdf" id="upload-document-2" class="form-control" onchange="return otherFileValidation(this)">
                      <input type="hidden" name="old_upload_document_2" value="<?=$news->upload_document_2?>">
                      <p class="help-block">Allowed File : jpeg, jpg, png, gif ,pdf, doc, docx, xls and xlsx</p>
                    </div>
                  </div>
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
  </section>
<?php $this->Html->script(['AdminLTE./plugins/ckeditor/ckeditor'],['block' => 'bottom-script']); ?>
<?php $this->append('bottom-script');?>
<script>
(function($){
  $(document).ready(function(){
    if(typeof $.validator !== "undefined"){
      $("#news-edit-frm").validate();
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