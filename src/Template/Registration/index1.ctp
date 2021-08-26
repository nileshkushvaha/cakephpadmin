<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 31, 2018, 6:16 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration[]|\Cake\Collection\CollectionInterface $registration
 */
$this->assign('title',__('Registration'));
$this->Html->addCrumb(__('Registration'));
?>
  <!-- Main content -->
  <section class="content registration index">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><?= __('List of') ?> <?= __('Registration') ?></h3>
            <div class="box-tools">
              <?=$this->Html->link(
                      __('<i class="glyphicon glyphicon-plus"></i> New Registration'),
                      ['action' => 'add'],
                      ['class' => 'btn btn-success', 'escape' => false, 'title' => __('Add New Registration')]
                  );?>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('designation_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('date_of_birth') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('shortname') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('gender') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('fax') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('district_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('pincode') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('star') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th width="100" scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($registration as $registration): ?>
                  <tr>
                        <td><?= $this->Number->format($registration->id) ?></td>
                        <td><?= $registration->has('user') ? $this->Html->link($registration->user->id, ['controller' => 'Users', 'action' => 'view', $registration->user->id]) : '' ?></td>
                        <td><?= $registration->has('designation') ? $this->Html->link($registration->designation->name, ['controller' => 'Designations', 'action' => 'view', $registration->designation->id]) : '' ?></td>
                        <td><?= h($registration->date_of_birth) ?></td>
                        <td><?= h($registration->shortname) ?></td>
                        <td><?= h($registration->name) ?></td>
                        <td><?= $this->Number->format($registration->gender) ?></td>
                        <td><?= h($registration->email) ?></td>
                        <td><?= h($registration->mobile) ?></td>
                        <td><?= h($registration->phone) ?></td>
                        <td><?= h($registration->fax) ?></td>
                        <td><?= $registration->has('state') ? $this->Html->link($registration->state->name, ['controller' => 'States', 'action' => 'view', $registration->state->id]) : '' ?></td>
                        <td><?= $registration->has('district') ? $this->Html->link($registration->district->name, ['controller' => 'Districts', 'action' => 'view', $registration->district->id]) : '' ?></td>
                        <td><?= $this->Number->format($registration->city_id) ?></td>
                        <td><?= h($registration->address) ?></td>
                        <td><?= $this->Number->format($registration->pincode) ?></td>
                        <td><?= $this->Number->format($registration->star) ?></td>
                        <td><?= h($registration->created) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $registration->id],['class' => 'btn btn-info btn-xs', 'title' => __('View'), 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $registration->id],['class' => 'btn btn-warning btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $registration->id], ['confirm' => __('Are you sure you want to delete this Registration?', $registration->id),'class' => 'btn btn-danger btn-xs', 'title' => __('Delete'), 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(count($registration) == 0):?>
                    <tr>
                        <td colspan="19"><?= __('Record not found!'); ?></td>
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