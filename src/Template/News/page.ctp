<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \December 5, 2018, 4:57 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Swavlamban $news
 */
$this->assign('title',!empty($news->meta_title)?$news->meta_title : $news->title);
$this->Html->meta('keywords', $news->meta_keywords, ['block' => true]);
$this->Html->meta('description', $news->meta_description, ['block' => true]);

$this->Breadcrumbs->add(__('News'),['action'=>'index']);
$this->Breadcrumbs->add(__($news->title));
?>
  <section class="inner-top wow fadeInDown">
    <?php echo $this->Html->image("../assets/img/inner-banner.jpg",["alt"=>'inner-banner','class'=>'img-responsive','width'=>'100%']); ?>
    <div class="breadcrumb-inner">
      <div class="container">
        <div class="row">
          <div class="col-md-12 wow fadeInDown">
            <div id="breadcrumb">
              <?= $this->element('breadcrumb'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ./section -->
  <div class="inner-main-sec">
    <div class="container">
      <div class="row">
        <div class="over-cont">
          <div class="col-md-12">
            <h2><?= $news->title; ?></h2>
            <?= $news->content; ?>
            <div class="box-2">
              <ul>
                <?php if (!empty($news->upload_document_1)) { ?>
                <li>
                  <a title="View" target="_blank" href="<?= $this->Url->build('/files/news/'. $news->upload_document_1);?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?=$news->upload_document_1?></a>
                </li>
                <?php } 
                if (!empty($news->upload_document_2)) { ?>
                <li>
                  <a title="View" target="_blank" href="<?= $this->Url->build('/files/news/'. $news->upload_document_2);?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?=$news->upload_document_2?></a>
                </li>
                <?php } ?>
              </ul>
            </div>
            <?php if (!empty($news->custom_link)) { ?>
              <a target="_blank" href="<?=$news->custom_link?>"><?=$news->custom_link?></a>
            <?php } ?>
          </div>          
      </div>
    </div>
  </div>
</div>