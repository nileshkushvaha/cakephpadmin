<?php
/**
 * Element : Header
 * Controll all Header Section.
 * @author : Nilesh Kushvaha
 * @version : 1.1
 * @since : 27 May 2020
 */
$lang = 'en';
if ($Configure::check('language')) {
  $lang = $Configure::read('language.culture');
}
$userData  = $this->request->getSession()->read('Auth.User');
?>
<!--? Preloader Start -->
<div id="preloader-active">
  <div class="preloader d-flex align-items-center justify-content-center">
    <div class="preloader-inner position-relative">
      <div class="preloader-circle"></div>
      <div class="preloader-img pere-text">
        <?=$this->Html->image("../assets/img/logo_new.png",["alt"=>"logo"])?>
      </div>
    </div>
  </div>
</div>
<!-- Preloader Start -->

<header>
  <!--? Header Start -->
  <div class="header-area header-transparent">
    <div class="main-header  header-sticky">
      <div class="container">
        <div class="row align-items-center">
          <!-- Logo -->
          <div class="col-xl-2 col-lg-2 col-md-1">
            <div class="logo">
              <?= $this->Html->link($this->Html->image("../assets/img/logo_new.png",["alt" => "logo"]),['controller'=>'Home','action'=>'index','_full'=>true],['escape'=>false,'title'=>'Shoeindex']); ?>
            </div>
          </div>
          <div class="col-xl-10 col-lg-10 col-md-10">
            <div class="menu-main d-flex align-items-center justify-content-end">
              <!-- Main-menu -->
              <div class="main-menu f-right d-none d-lg-block">
                <nav> 
                  <ul id="navigation">
                    <?php echo $this->Menu->render('main-menu'); ?>                  
                  </ul>
                </nav>
              </div>
              <div class="header-right-btn f-right d-none d-lg-block ml-20">
                <?php if (!empty($userData)) { ?>
                  <?= $this->Html->link(__('Dashboard'),['controller'=>'dashboard','action'=>'index'],['class'=>'border-btn header-btn']);?>
                <?php } else { ?>
                  <?= $this->Html->link(__('Login'),['controller'=>'Users','action'=>'login'],['class'=>'border-btn header-btn']); ?>
                <?php } ?>
              </div>
            </div>
          </div>   
          <!-- Mobile Menu -->
          <div class="col-12">
            <?= $this->Html->link(__('Login'),['controller'=>'Users','action'=>'login'],['class'=>'border-btn header-btn d-block d-lg-none']); ?>
            <div class="mobile_menu d-block d-lg-none">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Header End -->
</header>
<main>