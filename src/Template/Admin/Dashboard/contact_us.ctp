<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \October 13, 2020, 7:05 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
$this->assign('title',__('Contact Form'));
$this->Breadcrumbs->add(__('Contact Form'));
$name = isset($name)?$name:'';
$email = isset($email)?$email:'';
$phone = isset($phone)?$phone:'';
?>
<!-- Main content -->
<section class="content user index">
  <div class="row">
    <div class="col-md-12">
      <?= $this->Flash->render(); ?>
      <?= $this->Flash->render('auth'); ?>
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= __('Search - Contact Form'); ?></h3>
        </div> 
        <?= $this->Form->create('searchDriver',['id' =>'searchDriver','type'=>'get','class'=>'form-horizontal']); ?>
        <div class="box-body table-responsive">
          <?= $this->element('errorlist'); ?> 

          <div class="row2">
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Name:</label>
                <div class="col-sm-10">
                  <input type="text" name="name" id="name" maxlength="40" placeholder="Enter name" class="form-control" value="<?=$name?>">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                  <input type="email" name="email" id="email" maxlength="40" placeholder="Enter email" class="form-control" value="<?=$email?>">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label col-sm-2" for="role-id">Phone:</label>
                <div class="col-sm-10">
                  <input type="text" name="phone" id="phone" maxlength="15" placeholder="Enter phone number" class="form-control" value="<?=$phone?>">
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row3">
            <div class="col-md-5"></div>
            <div class="col-md-1"><button name="search_button" value="search_button" type="submit" class="btn btn-primary btn-green">Search</button></div>
            <div class="col-md-1">
              <?php if(empty($phone) && empty($email) && empty($name)){ ?>
                <button type="reset" class="btn btn-danger">Reset</button>                  
              <?php } else { ?>
                <?= $this->Html->link(__('Reset'),['controller'=>'Dashboard','action'=>'contactUs'],['class'=>'btn btn-danger']); ?>
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
            <?= __('List of') ?> <?= __('Contact Form') ?>
          </h3>            
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
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $paginatorInformation = $this->Paginator->params();
                $pageOffset=($paginatorInformation['page']-1);
                $perPage = $paginatorInformation['perPage'];
                $counter = ($pageOffset*$perPage);
                $i = 1;
                foreach ($contacts as $user): ?>
                <tr>
                  <td><?= $this->Number->format($i+$counter) ?>.</td>
                  <td><?= h($user->name) ?></td>
                  <td><?= h($user->email) ?></td>
                  <td><?= isset($user->phone)?$user->phone:''; ?></td>
                  <td><?= date('m-d-Y H:i A',strtotime($user->created)) ?></td>
                </tr>
              <?php $i++;
              endforeach;
              if(count($contacts) == 0):?>
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