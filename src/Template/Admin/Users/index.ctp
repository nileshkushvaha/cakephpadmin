<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 29, 2018, 7:05 am
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
$this->assign('title',__('Users'));
$this->Breadcrumbs->add(__('Users'));
$name = isset($name)?$name:'';
$email = isset($email)?$email:'';
$roleId = isset($roleId)?$roleId:'';
$status = isset($status)?$status:'';
$selectedId = isset($selectedId)?$selectedId:'';
?>
<!-- Main content -->
<section class="content user index">
  <div class="row">
    <div class="col-md-12">
      <?= $this->Flash->render(); ?>
      <?= $this->Flash->render('auth'); ?>
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= __('Search - Users'); ?></h3>
        </div> 
        <?= $this->Form->create('searchBanner',['id' =>'searchBanner','type'=>'get','class'=>'form-horizontal']); ?>
        <div class="box-body table-responsive">
          <?= $this->element('errorlist'); ?> 

          <div class="row2">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Name:</label>
                <div class="col-sm-10">
                  <input type="text" name="name" id="name" maxlength="40" placeholder="Enter name" class="form-control" value=<?=$name?>>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                  <input type="email" name="email" id="email" maxlength="40" placeholder="Enter email" class="form-control" value=<?=$email?>>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label col-sm-2" for="role-id">Role:</label>
                <div class="col-sm-10">
                  <?=$this->form->select('role_id',$roles,['class'=>'form-control','empty'=>'--Select--','value'=>$roleId,'label'=>false])?>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label col-sm-2" for="status">Status:</label>
                <div class="col-sm-10">
                  <?php $sOption = [0=>'Inactive',1=>'Active'];?>
                  <?=$this->form->select('status',$sOption,['class'=>'form-control','empty'=>'--Select--','value'=>$status,'label'=>false])?>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row3">
            <div class="col-md-5"></div>
            <div class="col-md-1"><button name="search_button" value="search_button" type="submit" class="btn btn-primary btn-green">Search</button></div>
            <div class="col-md-1">
              <?php if(empty($roleId) && empty($status) && empty($email) && empty($name)){ ?>
                <button type="reset" class="btn btn-danger">Reset</button>                  
              <?php } else { ?>
                <?= $this->Html->link(__('Reset'),['controller'=>'users','action'=>'index'],['class'=>'btn btn-danger']); ?>
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
        <?= $this->Form->create('page_number',['id'=>'user_list','type'=>'get','class'=>'form-inline']); ?>
        <div class="box-header">
          <h3 class="box-title">
            <?= __('List of') ?> <?= __('Users') ?>
          </h3>
          <div class="box-tools">
            <div class="form-group">
              <label for="page_length">Display:</label>
              <?php $page_length = array('10'=>'10','20'=>'20','50'=>'50','100'=>'100','200'=>'200','all'=>'All'); ?>
              <select class="form-control" name="page_length" id="page_length">
                <?= $this->OptionsData->list_toOption($page_length, $selectedId = $selectedLen)?>
              </select>
              <input type="hidden" name="role_id" value="<?=$roleId;?>">
              <input type="hidden" name="status" value="<?=$status;?>">
              <input type="hidden" name="email" value="<?=$email;?>">
              <input type="hidden" name="name" value="<?=$name;?>">
            </div>
            <button name="export_excel" value="export_excel" class="btn btn-primary">Export to Excel</button>
            <?=$this->Html->link(
              __('<i class="glyphicon glyphicon-plus"></i> New User'),
              ['action' => 'add'],
              ['class' => 'btn btn-success', 'escape' => false, 'title' => __('Add New User')]
            );?>              
          </div>              
        </div>
        <div class="clearfix"></div>
        <?= $this->Form->end()?>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th width="100" scope="col" class="actions"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $paginatorInformation = $this->Paginator->params();
              $pageOffset=($paginatorInformation['page']-1);
              $perPage = $paginatorInformation['perPage'];
              $counter = ($pageOffset*$perPage);
              $i = 1;
              foreach ($users as $user): ?>
                <tr>
                  <td><?= $this->Number->format($i+$counter)?>.</td>
                  <td><?= h($user->name) ?></td>
                  <td><?= h($user->username) ?></td>
                  <td><?= h($user->email) ?></td>
                  <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                  <td><?= $user->status ? __('Active') : __('Inactive'); ?></td>
                  <td><?= date('Y-m-d H:i A',strtotime($user->created)) ?></td>
                  <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $user->id],['class' => 'btn btn-info btn-xs', 'title' => __('View'), 'escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $user->id],['class' => 'btn btn-warning btn-xs', 'title' => __('Edit'), 'escape' => false]) ?>
                  </td>
                </tr>
              <?php $i++;
              endforeach; ?>
              <?php if(count($users) == 0):?>
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

<?php $this->append('bottom-script');?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#page_length').on('change',function () {
      $('#user_list').submit();
    })
  });
</script>
<?php $this->end();?>