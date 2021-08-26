<?php 
use Cake\Collection\Collection;
use Cake\Core\Configure; ?>
    <!-- Main content -->
    <section class="content">
      <div class="clearfix"></div>
      <?= $this->Flash->render();?>
      <ul>
          <?php //echo $this->Menu->render('main-menu'); ?>
      </ul>
      <p class="websitetitle"> <span>Welcome to</span> <?php echo Configure::read('Theme.title'); ?> </p>
    </section>
<style>
.websitetitle {
    font-size: 36px;
    text-align: center;
    padding-top: 100px;
    color: #657c12;
    font-weight: bold;
        padding-bottom: 86px;
}
p.websitetitle span {
    display: block;
    color: #00793e;
    font-weight: lighter;
    font-size: 30px;
    position: relative;
    margin-bottom: 15px;
}
p.websitetitle span:after {
    content: "";
    background: rgb(164, 210, 29);
    display: block;
    bottom: 0;
    width: 93px;
    height: 3px;
    margin: 0 auto;
    margin-top: 10px;
}
</style>