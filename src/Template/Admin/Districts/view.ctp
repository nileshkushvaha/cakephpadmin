<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:12 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District $district
 */
$this->assign('title',__('District ( ' . $district->name . ' ) '));
$this->Breadcrumbs->add(__('Districts'),['action'=>'index']);
$this->Breadcrumbs->add(__('District ( ' . $district->name . ' ) '));
?>

  <!-- Main content -->
  <section class="content district view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('District ( ' . $district->name . ' ) ') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to District'),'escape' => false]
                  );?>
                  <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit', $district->id],['class' => 'btn btn-warning  btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>

                  <?= $this->Form->postLink(
                    '<i class="fa fa-trash-o"></i>',
                    ['action' => 'delete', $district->id],
                    ['confirm' => __('Are you sure you want to delete this District?', $district->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                )?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <dl class="dl-horizontal">
                  <dt><?= __('State') ?></dt>
                  <dd><?= $district->has('state') ? $this->Html->link($district->state->name, ['controller' => 'States', 'action' => 'view', $district->state->id]) : '' ?></dd>
                  <dt><?= __('Name') ?></dt>
                  <dd><?= h($district->name) ?></dd>
                  <dt><?= __('Id') ?></dt>
                  <dd><?= $this->Number->format($district->id) ?></dd>
                  <dt><?= __('Flag') ?></dt>
                  <dd><?= $district->flag ? __('Active') : __('Inactive'); ?></dd>
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