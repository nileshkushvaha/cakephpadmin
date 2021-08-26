<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \February 2, 2019, 11:48 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gallery[]|\Cake\Collection\CollectionInterface $galleries
 */
$this->assign('title',__('Galleries'));
$this->Breadcrumbs->add(__('Galleries'));
?>
  <!-- Main content -->
  <section class="content gallery index">
    <div class="row">
      <div class="col-xs-12">
      <?= $this->Flash->render() ; ?>
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><?= __('List of') ?> <?= __('Galleries') ?></h3>
            <div class="box-tools">
              <?=$this->Html->link(
                __('<i class="glyphicon glyphicon-plus"></i> New Gallery'),
                ['action' => 'add'],
                ['class' => 'btn btn-success', 'escape' => false, 'title' => __('Add New Gallery')]
              );?>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('gallery_category_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('filename') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th width="100" scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($galleries as $gallery): ?>
                  <tr>
                    <td><?= $this->Number->format($gallery->id) ?></td>
                    <td><?= $gallery->has('gallery_category') ? $this->Html->link($gallery->gallery_category->title, ['controller' => 'GalleryCategories', 'action' => 'view', $gallery->gallery_category->id]) : '' ?></td>
                    <td><?php if (!empty($gallery->filename)) { ?>
                      <a target="_blank" href="<?= $this->Url->build('/files/galleries/'. $gallery->filename);?>"><?=$gallery->filename?></a>
                      <?php } ?></td>
                    <td><?= $gallery->status ? __('Active') : __('Inactive'); ?></td>
                    <td><?= h(date('Y-m-d H:i A',strtotime($gallery->created))); ?></td>
                    <td class="actions">
                      <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $gallery->id],['class' => 'btn btn-info btn-xs', 'title' => __('View'), 'escape' => false]) ?>
                      <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $gallery->id],['class' => 'btn btn-warning btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>
                      <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $gallery->id], ['confirm' => __('Are you sure you want to delete this Gallery?', $gallery->id),'class' => 'btn btn-danger btn-xs', 'title' => __('Delete'), 'escape' => false]) ?>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(count($galleries) == 0):?>
                    <tr>
                      <td colspan="10"><?= __('Record not found!'); ?></td>
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