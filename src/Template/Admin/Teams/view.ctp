<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \June 27, 2020, 10:14 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Team $team
 */
$this->assign('title',__('Team ( ' . $team->name . ' ) '));
$this->Breadcrumbs->add(__('Teams'),['action'=>'index']);
$this->Breadcrumbs->add(__('Team ( ' . $team->name . ' ) '));
?>

  <!-- Main content -->
  <section class="content team view">
     <div class="row">
        <div class="col-md-12">
           <div class="box box-solid">
              <div class="box-header with-border">
                 <i class="fa fa-info"></i>
                 <h3 class="box-title"><?= __('Team ( ' . $team->name . ' ) ') ?></h3>
                 <div class="box-tools pull-right">
                  <?=$this->Html->link(
                    '<i class="glyphicon glyphicon-arrow-left"></i>',
                    ['action' => 'index'],
                    ['class' => 'btn btn-info btn-xs','title' => __('Back to Team'),'escape' => false]
                  );?>
                  <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit', ],['class' => 'btn btn-warning  btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>

                  <?= $this->Form->postLink(
                    '<i class="fa fa-trash-o"></i>',
                    ['action' => 'delete', $team->id],
                    ['confirm' => __('Are you sure you want to delete this Team?', $team->id),'class' => 'btn btn-danger btn-xs','title' => __('Delete'),'escape' => false]
                )?>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                 <dl class="dl-horizontal">
              <dt><?= __('User') ?></dt>
              <dd><?= $team->has('user') ? $this->Html->link($team->user->username, ['controller' => 'Users', 'action' => 'view', $team->user->id]) : '' ?></dd>
              <dt><?= __('Name') ?></dt>
              <dd><?= h($team->name) ?></dd>
              <dt><?= __('Designation') ?></dt>
              <dd><?= h($team->designation) ?></dd>
              <dt><?= __('Profile Photo') ?></dt>
              <dd><?= h($team->profile_photo) ?></dd>
              <dt><?= __('Facebook Url') ?></dt>
              <dd><?= h($team->facebook_url) ?></dd>
              <dt><?= __('Linkedin Url') ?></dt>
              <dd><?= h($team->linkedin_url) ?></dd>
              <dt><?= __('Twitter Url') ?></dt>
              <dd><?= h($team->twitter_url) ?></dd>
              <dt><?= __('Id') ?></dt>
              <dd><?= $this->Number->format($team->id) ?></dd>
              <dt><?= __('Created') ?></dt>
              <dd><?= h($team->created) ?></dd>
              <dt><?= __('Updated') ?></dt>
              <dd><?= h($team->updated) ?></dd>
              <dt><?= __('Status') ?></dt>
              <dd><?= $team->status ? __('Yes') : __('No'); ?></dd>
              <dt><?= __('Content') ?></dt>
              <dd><?= $this->Text->autoParagraph(h($team->content)); ?></dd>
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