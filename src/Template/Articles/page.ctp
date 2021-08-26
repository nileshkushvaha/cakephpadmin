<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $article
 */
use Cake\Routing\Router;
$this->assign('title',__($article->title));
$this->assign('subtitle',__($article->title));
$this->Breadcrumbs->add(__($article->title));

$this->Html->meta('keywords', $article->title, ['block' => true]);
$this->Html->meta('description', $article->title, ['block' => true]);
?>
<section class="team-section why-us-section">
  <div class="container">
    <div class="row row-pb-lg align-items-center about-top-section">
      <div class="col-sm-12">
        <h2><?=$article->title; ?></h2>
        <?= $article->content; ?>
      </div>
    </div>
  </div>
</section>