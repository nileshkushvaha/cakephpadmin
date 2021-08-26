<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \November 23, 2018, 11:41 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Banner $banner
 */
$this->assign('title',__('Banner ( ' . $banner->title . ' ) '));
$this->Breadcrumbs->add(__('Banners'),['action'=>'index']);
$this->Breadcrumbs->add(__('Banner ( ' . $banner->title . ' ) '));
?>

  <!-- Main content -->
  <section class="content banner view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('Banner ( ' . $banner->title . ' ) ') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to Banner'),'escape' => false]
                  );?>
                  <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit', ],['class' => 'btn btn-warning  btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>

                  <?= $this->Form->postLink(
                    '<i class="fa fa-trash-o"></i>',
                    ['action' => 'delete', $banner->id],
                    ['confirm' => __('Are you sure you want to delete this Banner?', $banner->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                )?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                 <dl class="dl-horizontal">
              <dt><?= __('Title') ?></dt>
              <dd><?= h($banner->title) ?></dd>
              <dt><?= __('Banner Image') ?></dt>
              <dd><a title="View" class="btn btn-primary btn-sm" target="_blank" href="<?= $this->Url->build('/files/banners/'. $banner->banner_image);?>">View</a></dd>
              <dt><?= __('User') ?></dt>
              <dd><?= $banner->has('user') ? $this->Html->link($banner->user->username, ['controller' => 'Users', 'action' => 'view', $banner->user->id]) : '' ?></dd>
              <dt><?= __('Banner Category') ?></dt>
              <dd><?= h($banner->banner_category->name) ?></dd>
              <dt><?= __('Created') ?></dt>
              <dd><?= date('Y-m-d H:i A',strtotime($banner->created)) ?></dd>
              <dt><?= __('Updated') ?></dt>
              <dd><?= date('Y-m-d H:i A',strtotime($banner->updated)) ?></dd>
              <dt><?= __('Status') ?></dt>
              <dd><?= $banner->status ? __('Active') : __('InActive'); ?></dd>
              <dt><?= __('Excerpt') ?></dt>
              <dd><?= $this->Text->autoParagraph(h($banner->excerpt)); ?></dd>
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