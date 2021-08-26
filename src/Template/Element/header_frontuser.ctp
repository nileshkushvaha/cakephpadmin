<?php
/**
 * Element : Header
 * Controll all Header Section.
 * @author : Nilesh Kushvaha
 * @version : 1.1
 * @since : 01 July 2019
 */
$lang = 'en';
if ($Configure::check('language')) {
    $lang = $Configure::read('language.culture');
}
?>
  <!--================ Header Menu Area start =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container padd0">
          <?= $this->Html->link($this->Html->image("../assets/img/logo.jpg",["alt" => "logo"]),['controller'=>'Home','action'=>'index','_full'=>true],['escape'=>false,'class'=>'navbar-brand logo_head']); ?>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-end">
              <?= $this->Menu->render('main-menu'); ?>
            </ul>
          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->