<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:13 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
$this->assign('title',__('Role ( ' . $role->name . ' ) '));
$this->Breadcrumbs->add(__('Roles'),['action'=>'index']);
$this->Breadcrumbs->add(__('Role ( ' . $role->name . ' ) '));
?>

  <!-- Main content -->
  <section class="content role view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('Role ( ' . $role->name . ' ) ') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to Role'),'escape' => false]
                  );?>
                  <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit', $role->id],['class' => 'btn btn-warning  btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>

                  <?php /*  <?= $this->Form->postLink(
                    '<i class="fa fa-trash-o"></i>',
                    ['action' => 'delete', $role->id],
                    ['confirm' => __('Are you sure you want to delete this Role?', $role->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                ) */?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table">
                  <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($role->name) ?></td>
                    
                  </tr>
                  <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $role->status ? __('Yes') : __('No'); ?></td>
                  </tr>
                  <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= date('Y-m-d H:i A',strtotime($role->created)) ?></td>
                  </tr>
                  <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= date('Y-m-d H:i A',strtotime($role->modified)) ?></td>
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