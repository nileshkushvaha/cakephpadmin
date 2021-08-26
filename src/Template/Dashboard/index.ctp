<?php 
use Cake\Collection\Collection;
use Cake\Core\Configure;

$this->assign('title',__('Dashboard'));
$this->assign('subtitle',__('Dashboard'));
$this->Breadcrumbs->add(__('Dashboard'));

$this->Html->meta('keywords', 'Dashboard', ['block' => true]);
$this->Html->meta('description', "Dashboard", ['block' => true]);
$userData  = $this->request->getSession()->read('Auth.User');
$roleId = $userData['role_id'];
?>

<div class="admin-first-top site-admin-container">
  <?= $this->element('topbar'); ?>

  <section class="admin-banner-section mt-4">
    <div class="container ">
      <div class="row">
        <div class="col-12">
          <div class="intro-banner">
            <h3>Welcome <?=$userData['name']?>!</h3>
            <p>Need anything more to know more? Feel free to contact us at any point.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="admin-dashboadReport-section mb-5">
    <div class="container ">
        <div class="row">
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
              <div class="card-body">
                <img src="https://www.bootstrapdash.com/demo/purple/jquery/template/assets/images/dashboard/circle.svg" class="card-img-absolute">
                <h4 class="font-weight-normal mb-3"> Total Job Post </h4>
                <h2 class="mb-5"><?= $this->Number->format(0) ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="https://www.bootstrapdash.com/demo/purple/jquery/template/assets/images/dashboard/circle.svg" class="card-img-absolute">
                <h4 class="font-weight-normal mb-3"> Total Driver Hired </h4>
                <h2 class="mb-5"><?= $this->Number->format(0) ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
              <div class="card-body">
                <img src="https://www.bootstrapdash.com/demo/purple/jquery/template/assets/images/dashboard/circle.svg" class="card-img-absolute">
                <h4 class="font-weight-normal mb-3"> Total Paid Invoices </h4>
                <h2 class="mb-5"><?= $this->Number->format(0) ?></h2>
              </div>
            </div>
          </div>
        </div>

    </div>
  </section>
</div>
<?php $this->append('bottom-script');?>
<?php $this->end();?>


