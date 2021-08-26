<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $article
 */
$this->assign('title',!empty($article->meta_title)?$article->meta_title : $article->title);
$this->assign('subtitle',__($article->title));
$this->Html->meta('keywords', $article->meta_keywords, ['block' => true]);
$this->Html->meta('description', $article->meta_description, ['block' => true]);
$this->Breadcrumbs->add(__($article->title));
?>
<section class="team-section">
  <div class="container">
    <h2>Meet Our Professionals</h2>
    <p> When your mission is to be better, faster and smarter, you need the best people driving your vision forward.</p>
    <div class="row mt-5 ">
      <?php if (!empty($teams)) {
        foreach ($teams as $key => $team) { ?>
      <div class="col-md-3 mb-5">
        <div class="item">
          <div class="photo medizin-image">
            <img src="<?= $this->Url->build('/files/teams/'. $team['profile_photo'],true);?>" width="480" alt="<?=$team['name']?>" title="<?=$team['name']?>">
            <div class="overlay"></div>
            <div class="social-networks">
              <div class="inner"> 
                <a href="<?=$team['facebook_url']?>" target="_blank" rel="nofollow"> <span class="link-icon fab fa-facebook-f"></span> </a> 
                <a href="<?=$team['twitter_url']?>" target="_blank" rel="nofollow"> <span class="link-icon fab fa-twitter"></span> </a> 
                <a href="#" target="_blank" rel="nofollow"> <span class="link-icon fab fa-instagram"></span> </a> 
                <a href="<?=$team['linkedin_url']?>" target="_blank" rel="nofollow"> <span class="link-icon fab fa-linkedin"></span> </a>
              </div>
            </div>
          </div>
          <div class="info">
            <div class="name-wrap">
              <h3 class="name"> <?=$team['name']?></h3>
            </div>
            <div class="position"><?=$team['designation']?></div>
          </div>
        </div>
      </div>
      <?php 
          } 
        }
        ?>
    </div>
  </div>
</section>