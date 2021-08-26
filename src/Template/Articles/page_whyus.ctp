<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $article
 */
use Cake\Routing\Router;
$this->assign('title',!empty($article->meta_title)?$article->meta_title : $article->title);
$this->assign('subtitle',__($article->title));
$this->Html->meta('keywords', $article->meta_keywords, ['block' => true]);
$this->Html->meta('description', $article->meta_description, ['block' => true]);
$this->Breadcrumbs->add(__($article->title));
?>

<section class="team-section why-us-section">
  <div class="container">
    <h2>Why Us</h2>
    <p> When your mission is to be better, faster and smarter, you need the best people driving your vision forward.</p>
    <div class="row mt-5">
      <div class="col-md-4">
       <div class="item box-content-wrapper">
        <h3>
         Business Experience
       </h3>
       <p>
         What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has
       </p>
     </div>
   </div>
   <div class="col-md-4">
     <div class="item box-content-wrapper">
      <h3>
       Vertical and Domain Expertise
     </h3>
     <p>
       What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has
     </p>
   </div>
 </div>
 <div class="col-md-4">
   <div class="item box-content-wrapper">
    <h3>
     Technology Competence
   </h3>
   <p>
     What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has
   </p>
 </div>
</div>

</div>
</div>
</section>