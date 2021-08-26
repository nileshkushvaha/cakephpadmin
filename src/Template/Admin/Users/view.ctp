<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:05 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->assign('title',__('User ( ' . $user->name . ' ) '));

$this->Breadcrumbs->add(__('Users'),['action'=>'index']);
$this->Breadcrumbs->add(__('User ( ' . $user->name . ' ) '));
?>

  <!-- Main content -->
  <section class="content user view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('User ( ' . $user->name . ' ) ') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to User'),'escape' => false]
                  );?>
                  <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit',$user->id],['class' => 'btn btn-warning  btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>

                  <?php /* <?= $this->Form->postLink(
                    '<i class="fa fa-trash-o"></i>',
                    ['action' => 'delete', $user->id],
                    ['confirm' => __('Are you sure you want to delete this User?', $user->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                )*/?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered">
                  <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                  </tr>
                  <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                    <th><?= __('Role') ?></th>
                    <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                  </tr>
                  <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= date('Y-m-d H:i A',strtotime($user->created)) ?></td>
                    <th><?= __('Status') ?></th>
                    <td><?= $user->status ? __('Active') : __('Inactive'); ?></td>
                  </tr>
                </table>
              </div>
              <!-- /.box-body -->
           </div>
           <!-- /.box -->
        </div>
        <!-- ./col -->
     </div>
     <!-- div -->
 </section>