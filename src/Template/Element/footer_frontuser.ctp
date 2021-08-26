<?php
/**
 * Element : Footer
 * Controll all footer content.
 * @author : Nilesh Kushvaha
 * @version : 1.1
 * @since : 24 October 2018
 */
use Cake\Core\Configure;
?>
<section class="footer-dd">
  <div class="container">
    <div class="col-md-12 copyright-text">
      <p class="mb-0">Copyright &copy; <?=date('Y')?> <?= Configure::read('Theme.title'); ?>. All Rights Reserved.</p>
    </div>
  </div>
</section>