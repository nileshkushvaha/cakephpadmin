<?php
$lang = 'en';
if ($Configure::check('language')) {
  $lang = $Configure::read('language.culture');
}
$this->assign('title', 'Home');
$this->Html->meta('keywords', 'drivers hub', ['block' => true]);
$this->Html->meta('description', 'drivers hub', ['block' => true]);
$userArr  = $this->request->getSession()->read('Auth.User');
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="about-wrap">
        <h2 class="text-center">Welcome to Shoeindex</h2>
        <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
        <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
        <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
        <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
        <div class="text-center">
          <?php if (!empty($userArr)) { ?>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'btn btn-primary btn-lg']); ?>
            <?= $this->Html->link(__('Logout'), ['controller' => 'users', 'action' => 'logout'], ['class' => 'btn btn-primary btn-lg']); ?>
          <?php } else { ?>
            <?= $this->Html->link(__('Signup'), ['controller' => 'users', 'action' => 'registration'], ['class' => 'btn btn-danger btn-lg']); ?>
            <?= $this->Html->link(__('Login'), ['controller' => 'users', 'action' => 'login'], ['class' => 'btn btn-primary btn-lg']); ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->append('bottom-script'); ?>
<script>
</script>
<?php $this->end(); ?>