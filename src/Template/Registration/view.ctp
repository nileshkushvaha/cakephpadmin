<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 31, 2018, 6:16 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration $registration
 */
$this->assign('title',__('Registration ( ' . $registration->name . ' ) '));

$this->Html->addCrumb(__('Registration'),['action'=>'index']);
$this->Html->addCrumb(__('Registration ( ' . $registration->name . ' ) '));
?>

  <!-- Main content -->
  <section class="content registration view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('Registration ( ' . $registration->name . ' ) ') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to Registration'),'escape' => false]
                  );?>
                  <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit', ],['class' => 'btn btn-warning  btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>

                  <?= $this->Form->postLink(
                    '<i class="fa fa-trash-o"></i>',
                    ['action' => 'delete', $registration->id],
                    ['confirm' => __('Are you sure you want to delete this Registration?', $registration->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                )?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                 <dl class="dl-horizontal">
              <dt><?= __('User') ?></dt>
              <dd><?= $registration->has('user') ? $this->Html->link($registration->user->id, ['controller' => 'Users', 'action' => 'view', $registration->user->id]) : '' ?></dd>
              <dt><?= __('Designation') ?></dt>
              <dd><?= $registration->has('designation') ? $this->Html->link($registration->designation->name, ['controller' => 'Designations', 'action' => 'view', $registration->designation->id]) : '' ?></dd>
              <dt><?= __('Shortname') ?></dt>
              <dd><?= h($registration->shortname) ?></dd>
              <dt><?= __('Name') ?></dt>
              <dd><?= h($registration->name) ?></dd>
              <dt><?= __('Email') ?></dt>
              <dd><?= h($registration->email) ?></dd>
              <dt><?= __('Mobile') ?></dt>
              <dd><?= h($registration->mobile) ?></dd>
              <dt><?= __('Phone') ?></dt>
              <dd><?= h($registration->phone) ?></dd>
              <dt><?= __('Fax') ?></dt>
              <dd><?= h($registration->fax) ?></dd>
              <dt><?= __('State') ?></dt>
              <dd><?= $registration->has('state') ? $this->Html->link($registration->state->name, ['controller' => 'States', 'action' => 'view', $registration->state->id]) : '' ?></dd>
              <dt><?= __('District') ?></dt>
              <dd><?= $registration->has('district') ? $this->Html->link($registration->district->name, ['controller' => 'Districts', 'action' => 'view', $registration->district->id]) : '' ?></dd>
              <dt><?= __('Address') ?></dt>
              <dd><?= h($registration->address) ?></dd>
              <dt><?= __('Id') ?></dt>
              <dd><?= $this->Number->format($registration->id) ?></dd>
              <dt><?= __('Gender') ?></dt>
              <dd><?= $this->Number->format($registration->gender) ?></dd>
              <dt><?= __('City Id') ?></dt>
              <dd><?= $this->Number->format($registration->city_id) ?></dd>
              <dt><?= __('Pincode') ?></dt>
              <dd><?= $this->Number->format($registration->pincode) ?></dd>
              <dt><?= __('Star') ?></dt>
              <dd><?= $this->Number->format($registration->star) ?></dd>
              <dt><?= __('Date Of Birth') ?></dt>
              <dd><?= h($registration->date_of_birth) ?></dd>
              <dt><?= __('Created') ?></dt>
              <dd><?= h($registration->created) ?></dd>
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