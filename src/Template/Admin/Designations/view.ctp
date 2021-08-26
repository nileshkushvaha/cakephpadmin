<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:06 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Designation $designation
 */
$this->assign('title',__('Designation ( ' . $designation->name . ' ) '));
$this->Breadcrumbs->add(__('Designations'),['action'=>'index']);
$this->Breadcrumbs->add(__('Designation ( ' . $designation->name . ' ) '));
?>

  <!-- Main content -->
  <section class="content designation view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('Designation ( ' . $designation->name . ' ) ') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to Designation'),'escape' => false]
                  );?>
                  <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit', $designation->id],['class' => 'btn btn-warning  btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>

                  <?= $this->Form->postLink(
                    '<i class="fa fa-trash-o"></i>',
                    ['action' => 'delete', $designation->id],
                    ['confirm' => __('Are you sure you want to delete this Designation?', $designation->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                )?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                    <tr>
                      <th><?= __('Department') ?></th> 
                      <td><?= $designation->has('department') ? $this->Html->link($designation->department->name, ['controller' => 'Departments', 'action' => 'view', $designation->department->id]) : '' ?></td>                                         
                      <th><?= __('Created') ?></th>
                      <td><?= date('Y-m-d H:i A',strtotime($designation->created)) ?></td>                  
                    </tr>
                    <tr>                      
                      <th><?= __('Name') ?></th>
                      <td><?= h($designation->name) ?></td>  
                      <th><?= __('Status') ?></th>
                      <td><?= $designation->status ? __('Yes') : __('No'); ?></td>                      
                    </tr>
                  </tbody>
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