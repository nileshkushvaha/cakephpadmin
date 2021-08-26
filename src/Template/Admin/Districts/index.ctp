<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:12 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District[]|\Cake\Collection\CollectionInterface $districts
 */
$this->assign('title',__('Districts'));
$this->Breadcrumbs->add(__('Districts'));
?>
  <!-- Main content -->
  <section class="content district index">
    <div class="row">
      <div class="col-xs-12">
        <?= $this->Flash->render(); ?>
        <?= $this->Flash->render('auth'); ?>
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><?= __('List of') ?> <?= __('Districts') ?></h3>
            <div class="box-tools">
              <?=$this->Html->link(
                __('<i class="glyphicon glyphicon-plus"></i> New District'),
                ['action' => 'add'],
                ['class' => 'btn btn-success', 'escape' => false, 'title' => __('Add New District')]
              );?>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('flag','Status') ?></th>
                  <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($districts as $district): ?>
                  <tr>
                    <td><?= $this->Number->format($district->id) ?></td>
                    <td><?= $district->has('state') ? $this->Html->link($district->state->name, ['controller' => 'States', 'action' => 'view', $district->state->id]) : '' ?></td>
                    <td><?= h($district->name) ?></td>
                    <td><?= $district->flag ? __('Active') : __('InActive') ?></td>
                    <td class="actions">
                      <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $district->id],['class' => 'btn btn-info btn-xs', 'title' => __('View'), 'escape' => false]) ?>
                      <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $district->id],['class' => 'btn btn-warning btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>
                      <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $district->id], ['confirm' => __('Are you sure you want to delete this District?', $district->id),'class' => 'btn btn-danger btn-xs', 'title' => __('Delete'), 'escape' => false]) ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php if(count($districts) == 0):?>
                  <tr>
                    <td colspan="5"><?= __('Record not found!'); ?></td>
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