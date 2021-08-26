<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \November 23, 2018, 11:41 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Banner[]|\Cake\Collection\CollectionInterface $banners
 */
$this->assign('title',__('Banners'));
$this->Breadcrumbs->add(__('Banners'));
$selectedLen = isset($selectedLen)?$selectedLen:'';
$bannerTitle = isset($bannerTitle)?$bannerTitle:'';
$bannerCatId = isset($bannerCatId)?$bannerCatId:'';
?>
  <!-- Main content -->
  <section class="content banner index">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <?= $this->Flash->render('auth'); ?>
        <div class="box box-primary">
          <div class="box-header">
              <h3 class="box-title"><?= __('Search - Banners'); ?></h3>
          </div> 
          <?= $this->Form->create('searchRoles',['id' =>'searchRoles','type'=>'get']); ?>
            <div class="box-body table-responsive">
              <?= $this->element('errorlist'); ?> 

              <div class="row2">    
                <div class="col-md-2"></div>
                <div class="col-md-1"><label for="page_name">Banners</label></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="text" name="title" id="title" maxlength="40" placeholder="Enter title" class="form-control" value=<?=$bannerTitle?>>
                  </div>
                </div>
                <div class="col-md-1"><label for="banner-category-id">Status</label></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <?=$this->form->select('banner_category_id',$bannerCategories,['class'=>'form-control','empty'=>'--Select--','value'=>$bannerCatId])?>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row3">
                <div class="col-md-5"></div>
                <div class="col-md-1"><button name="search_button" value="search_button" type="submit" class="btn btn-primary btn-green">Search</button></div>
                <div class="col-md-1">
                  <?php if(empty($bannerTitle) && empty($bannerCatId)){ ?>
                    <button type="reset" class="btn btn-danger">Reset</button>                  
                  <?php } else { ?>
                    <?= $this->Html->link(__('Reset'),['controller'=>'banners','action'=>'index'],['class'=>'btn btn-danger']); ?>
                  <?php }?>
                </div>
              </div>
              <div class="clearfix"></div>
              <br>
              <input type="hidden" name="page_length" value="<?=@$selectedLen?>">
          </div>
          <?= $this->Form->end(); ?>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><?= __('List of') ?> <?= __('Banners') ?></h3>
            <div class="box-tools">
              <?=$this->Html->link(
                      __('<i class="glyphicon glyphicon-plus"></i> New Banner'),
                      ['action' => 'add'],
                      ['class' => 'btn btn-success', 'escape' => false, 'title' => __('Add New Banner')]
                  );?>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('banner_category_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('banner_image') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th width="100" scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($banners as $banner): ?>
                  <tr>
                    <td><?= $this->Number->format($banner->id) ?></td>
                    <td><?= h($banner->title) ?></td>
                    <td><?= h($banner->banner_category->name) ?></td>
                    <td><a title="View" class="btn btn-primary btn-sm" target="_blank" href="<?= $this->Url->build('/files/banners/'. $banner->banner_image);?>">View</a></td>
                    <td><?= $banner->status ? __('Active') : __('InActive'); ?></td>
                    <td><?= $banner->has('user') ? $this->Html->link($banner->user->username, ['controller' => 'Users', 'action' => 'view', $banner->user->id]) : '' ?></td>
                    <td><?= date('Y-m-d H:i A',strtotime($banner->created)) ?></td>
                    <td class="actions">
                      <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $banner->id],['class' => 'btn btn-info btn-xs', 'title' => __('View'), 'escape' => false]) ?>
                      <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $banner->id],['class' => 'btn btn-warning btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>
                      <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $banner->id], ['confirm' => __('Are you sure you want to delete this Banner?', $banner->id),'class' => 'btn btn-danger btn-xs', 'title' => __('Delete'), 'escape' => false]) ?>
                    </td>
                  </tr>
                    <?php endforeach; ?>
                    <?php if(count($banners) == 0):?>
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