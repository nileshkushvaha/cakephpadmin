<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \December 27, 2018, 11:25 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News $news
 */
$this->assign('title',__('News ( ' . $news->title . ' ) '));
$this->Breadcrumbs->add(__('News'),['action'=>'index']);
$this->Breadcrumbs->add(__('News'));
?>

  <!-- Main content -->
  <section class="content news view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('News') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to News'),'escape' => false]
                  );?>
                  <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit',$news->id ],['class' => 'btn btn-warning  btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>

                  <?= $this->Form->postLink(
                    '<i class="fa fa-trash-o"></i>',
                    ['action' => 'delete', $news->id],
                    ['confirm' => __('Are you sure you want to delete this News?', $news->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                )?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                 <dl class="dl-horizontal">
              <dt><?= __('Title') ?></dt>
              <dd><?= h($news->title) ?></dd>
              <dt><?= __('News Url') ?></dt>
              <dd><?php
                  $lOption = ['prefix'=>false,'controller'=>'news','action'=>'page','id'=>$news->id];
                  $link = $this->Url->build($lOption, ['pass' => ['id'], 'fullBase' => true]);
                  echo $this->Html->link($link, $link, ['target' => '_blank']);?>
              </dd>
              <dt><?= __('User') ?></dt>
              <dd><?= $news->has('user') ? $this->Html->link($news->user->username, ['controller' => 'Users', 'action' => 'view', $news->user->id]) : '' ?></dd>
              <dt><?= __('Custom Link') ?></dt>
              <dd><?= h($news->custom_link) ?></dd>
              <dt><?= __('Header Image') ?></dt>
              <dd><label><?php if ($news->header_image) { ?><a title="View" target="_blank" href="<?= $this->Url->build('/files/news/'. $news->header_image);?>">View</a> <?php } ?></label></dd> 
              <dt><?= __('Upload Document 1') ?></dt>
              <dd><?php if ($news->upload_document_1) { ?><a title="View" target="_blank" href="<?= $this->Url->build('/files/news/'. $news->upload_document_1);?>"><?=$news->upload_document_1?></a> <?php } ?></dd>
              <dt><?= __('Upload Document 2') ?></dt>
              <dd><?php if ($news->upload_document_2) { ?><a title="View" target="_blank" href="<?= $this->Url->build('/files/news/'. $news->upload_document_2);?>"><?=$news->upload_document_2?></a> <?php } ?></dd>
              <dt><?= __('Sort Order') ?></dt>
              <dd><?= $this->Number->format($news->sort_order) ?></dd>
              <dt><?= __('Display Date') ?></dt>
              <dd><?= date('Y-m-d H:i A',strtotime($news->display_date)) ?></dd>
              <dt><?= __('Created') ?></dt>
              <dd><?= date('Y-m-d H:i A',strtotime($news->created)) ?></dd>
              <dt><?= __('Updated') ?></dt>
              <dd><?= date('Y-m-d H:i A',strtotime($news->updated)) ?></dd>
              <dt><?= __('Status') ?></dt>
              <dd><?= $news->status ? __('Yes') : __('No'); ?></dd>
              <dt><?= __('Subtitle') ?></dt>
              <dd><?= $this->Text->autoParagraph(h($news->subtitle)); ?></dd>
              <dt><?= __('Content') ?></dt>
              <dd><?= $this->Text->autoParagraph(h($news->content)); ?></dd>
          </dl>
              </div>
              <!-- /.box-body -->
           </div>
           <!-- /.box -->
        </div>
        <!-- ./col -->
     </div>
     <!-- div -->
 </section>