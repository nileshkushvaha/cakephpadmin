<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \June 27, 2020, 10:14 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Team[]|\Cake\Collection\CollectionInterface $teams
 */
$this->assign('title',__('Teams'));
$this->Breadcrumbs->add(__('Teams'));
?>
  <!-- Main content -->
  <section class="content team index">
    <div class="row">
      <div class="col-xs-12">
      <?= $this->Flash->render() ; ?>
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><?= __('List of') ?> <?= __('Teams') ?></h3>
            <div class="box-tools">
              <?=$this->Html->link(
                      __('<i class="glyphicon glyphicon-plus"></i> New Team'),
                      ['action' => 'add'],
                      ['class' => 'btn btn-success', 'escape' => false, 'title' => __('Add New Team')]
                  );?>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('designation') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('profile_photo') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th width="100" scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($teams as $team): ?>
                  <tr>
                        <td><?= $this->Number->format($team->id) ?></td>
                        <td><?= h($team->name) ?></td>
                        <td><?= h($team->designation) ?></td>
                        <td><?php if (!empty($team->profile_photo)) { ?>
                          <a title="View" class="btn btn-primary btn-sm" target="_blank" href="<?= $this->Url->build('/files/teams/'. $team->profile_photo);?>">View</a>
                        <?php } ?>                          
                        </td>
                        <td><?= $team->status ? __('Active') : __('InActive'); ?></td>
                        <td><?= date('m-d-Y h:i A',strtotime($team->created)) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $team->id],['class' => 'btn btn-info btn-xs', 'title' => __('View'), 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $team->id],['class' => 'btn btn-warning btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $team->id], ['confirm' => __('Are you sure you want to delete this Team?', $team->id),'class' => 'btn btn-danger btn-xs', 'title' => __('Delete'), 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(count($teams) == 0):?>
                    <tr>
                        <td colspan="13"><?= __('Record not found!'); ?></td>
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