<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \February 2, 2019, 11:47 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GalleryCategory[]|\Cake\Collection\CollectionInterface $galleryCategories
 */
$this->assign('title',__('Video Gallery Categories'));
$this->Breadcrumbs->add(__('Video Gallery Categories'));
?>
  <!-- Main content -->
  <section class="content galleryCategory index">
    <div class="row">
      <div class="col-xs-12">
      <?= $this->Flash->render() ; ?>
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><?= __('List of') ?> <?= __('Video Gallery Categories') ?></h3>
            <div class="box-tools">
              <?=$this->Html->link(
                __('<i class="glyphicon glyphicon-plus"></i> New Video Gallery Category'),
                ['action' => 'video-category-add'],
                ['class' => 'btn btn-success', 'escape' => false, 'title' => __('Add New Video Gallery Category')]
              );?>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                   
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th width="100" scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($videoCategories as $galleryCategory): ?>
                  <tr>
                    <td><?= $this->Number->format($galleryCategory->id) ?></td>
                    
                    <td><?= h($galleryCategory->title) ?></td>
                    <td><?= $galleryCategory->status ? __('Active') : __('Inactive'); ?></td>
                    <td><?= h(date('Y-m-d H:i A',strtotime($galleryCategory->created))); ?></td>
                    <td class="actions">
                        <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'video-category-view', $galleryCategory->id],['class' => 'btn btn-info btn-xs', 'title' => __('View'), 'escape' => false]) ?>
                        <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'video-category-edit', $galleryCategory->id],['class' => 'btn btn-warning btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>
                        <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'video-category-delete', $galleryCategory->id], ['confirm' => __('Are you sure you want to delete this Gallery Category?', $galleryCategory->id),'class' => 'btn btn-danger btn-xs', 'title' => __('Delete'), 'escape' => false]) ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(count($videoCategories) == 0):?>
                    <tr>
                        <td colspan="8"><?= __('Record not found!'); ?></td>
                    </tr>
                    <?php endif;?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <?= $this->Paginator->first('<<') ?>
              <?= $this->Paginator->prev('<') ?>
              <?= $this->Paginator->numbers() ?>
              <?= $this->Paginator->next('>') ?>
              <?= $this->Paginator->last('>>') ?>
            </ul>
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>