<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \February 2, 2019, 11:48 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gallery $gallery
 */
$this->assign('title',__('Gallery ( ' . $gallery->id . ' ) '));
$this->Breadcrumbs->add(__('Galleries'),['action'=>'index']);
$this->Breadcrumbs->add(__('Gallery ( ' . $gallery->id . ' ) '));
?>

  <!-- Main content -->
  <section class="content gallery view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('Gallery ( ' . $gallery->id . ' ) ') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to Gallery'),'escape' => false]
                  );?>
                  <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit', ],['class' => 'btn btn-warning  btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>

                  <?= $this->Form->postLink(
                    '<i class="fa fa-trash-o"></i>',
                    ['action' => 'delete', $gallery->id],
                    ['confirm' => __('Are you sure you want to delete this Gallery?', $gallery->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                )?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                 <dl class="dl-horizontal">
              <dt><?= __('Gallery Category') ?></dt>
              <dd><?= $gallery->has('gallery_category') ? $this->Html->link($gallery->gallery_category->title, ['controller' => 'GalleryCategories', 'action' => 'view', $gallery->gallery_category->id]) : '' ?></dd>
              <dt><?= __('Filesize') ?></dt>
              <dd><?= h($gallery->filesize) ?></dd>
              <dt><?= __('Weight') ?></dt>
              <dd><?= h($gallery->weight) ?></dd>
              <dt><?= __('Id') ?></dt>
              <dd><?= $this->Number->format($gallery->id) ?></dd>
              <dt><?= __('Created') ?></dt>
              <dd><?= h($gallery->created) ?></dd>
              <dt><?= __('Status') ?></dt>
              <dd><?= $gallery->status ? __('Yes') : __('No'); ?></dd>
              <dt><?= __('Filename') ?></dt>
              <dd><?= $this->Text->autoParagraph(h($gallery->filename)); ?></dd>
              <dt><?= __('Filemime') ?></dt>
              <dd><?= $this->Text->autoParagraph(h($gallery->filemime)); ?></dd>
              <dt><?= __('Description') ?></dt>
              <dd><?= $this->Text->autoParagraph(h($gallery->description)); ?></dd>
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