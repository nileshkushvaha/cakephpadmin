<?php
/**
 * Element : Topbar
 * Controll all Topbar Section.
 * @author : Nilesh Kushvaha
 * @version : 1.1
 * @since : 01 July 2019
 */
$lang = 'en';
if ($Configure::check('language')) {
    $lang = $Configure::read('language.culture');
}
$userData  = $this->request->getSession()->read('Auth.User');
$roleId = $userData['role_id'];
?>

<?php /* if (!empty($userData)) { ?>
  <?= $this->Html->link(__('Dashboard'),['controller'=>'dashboard','action'=>'index'],['class'=>'btn btn-primary btn-lg']);?>
  <?= $this->Html->link(__('Logout'),['controller'=>'users','action' => 'logout'],['class'=>'btn btn-primary btn-lg']);?>
<?php } else { ?>
  <?= $this->Html->link(__('Create an Account'),['controller'=>'users','action' => 'registration'],['class'=>'btn btn-primary btn-lg']);?>
  <?= $this->Html->link(__('Login'),['controller'=>'users','action' => 'login'],['class'=>'btn btn-primary btn-lg']);?>
<?php } */ ?>
<?php
$action = !empty($this->request->getParam('action')) ? $this->request->getParam('action') : null;
$controller = !empty($this->request->getParam('controller')) ? $this->request->getParam('controller') : null;
?>

<nav class="navbar navbar-expand-md navbar-dark navbar-custom p-0">
<div class="container">
    <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($controller=='Dashboard' && $action=='index'){echo "active";}?>">
                <?= $this->Html->link(__('<i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>'),['controller'=>'Dashboard','action'=>'index'],['escape'=>false,'class'=>'nav-link']);?>
            </li>
            <li class="nav-item <?php if($controller=='MyProfile' && $action=='index'){echo "active";}?>">
                <?= $this->Html->link(__('<i class="fa fa-user" aria-hidden="true"></i> <span>My Profile</span>'),['controller'=>'MyProfile','action' => 'index'],['escape'=>false,'class'=>'nav-link']);?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> <span>Watchlist</span>'),['controller'=>'MyProfile','action' => 'index'],['escape'=>false,'class'=>'nav-link']);?>
            </li>
            
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-envelope"></i> Contact <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if($controller=='Users' && $action=='changePassword'){echo "active";}?>">
                <?= $this->Html->link(__('<i class="fas fa-cog" aria-hidden="true"></i> <span>Settings</span>'),['controller'=>'Users','action' => 'changePassword'],['escape'=>false,'class'=>'nav-link']);?>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?=$userData['name']?> </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                    <?= $this->Html->link(__('My Profile'),['controller'=>'MyProfile','action' => 'index'],['escape'=>false,'class'=>'dropdown-item']);?>
                    <?= $this->Html->link(__('Log out'),['controller'=>'users','action' => 'logout'],['escape'=>false,'class'=>'dropdown-item']);?>
                </div>
            </li>
        </ul>
    </div>
</div>
</nav>