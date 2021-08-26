<?php
$lang = 'en';
if ($Configure::check('language')) {
  $lang = $Configure::read('language.culture');
}
$this->assign('title', 'Home');
$this->Html->meta('keywords','drivers hub', ['block' => true]);
$this->Html->meta('description','drivers hub', ['block' => true]);
$userArr  = $this->request->getSession()->read('Auth.User');
?>
<section id="container">
  <div class="homeBanner">
    <div class="innerbanner">
        <h2 class="page-title text-center">Search Results</h2>
    </div>
  </div>
  <div class="content search-content">
   <div class="feildRow cf search-result-wrapper">
      <div class="feildCol">
         <div class="feildInput">
            <div class="search_keywords">
               <label for="search_keywords">Keywords</label>
               <input type="text" name="search_keywords" id="search_keywords" placeholder="Keywords" value="">
            </div>
         </div>
      </div>
      <div class="feildCol">
         <div class="feildInput">
            <div class="search_location">
               <label for="search_location">Location</label>
               <input type="text" name="search_location" id="search_location" placeholder="Location" value="">
            </div>
         </div>
      </div>
      <div class="search-button-wrapper">
       <button class="commonBtn" type="submit"> <span>Search</span> </button>
      </div>
   </div>

   <ul class="job_listings">
      <li id="" class="job_listing"   data-title="" data-href="">
         <a href="#" class="job_listing-clickbox">
         </a>
         <div class="job_listing-logo">
            <img src="/dev/drivers-hub/img/../assets/img/logo.png" alt="logo" class="company-logo">
         </div>
         <div class="job_listing-about">
            <div class="job_listing-position job_listing__column">
               <h3 class="job_listing-title">Driver</h3>
            </div>
            <div class="job_listing-location job_listing__column">
               <a class="google_map_link" href="http://maps.google.com/maps?q=Stoke-on-Trent&amp;zoom=14&amp;size=512x512&amp;maptype=roadmap&amp;sensor=false" target="_blank">Stoke-on-Trent</a>  
            </div>
            <ul class="job_listing-meta job_listing__column">
               <li class="apply"><a href="#" class="commonBtn">apply now</a></li>
               <li class="details"><a href="#" class="commonBtn">view details</a></li>
            </ul>
         </div>
      </li>
      <li id="" class="job_listing"   data-title="" data-href="">
         <a href="#" class="job_listing-clickbox">
         </a>
         <div class="job_listing-logo">
            <img src="/dev/drivers-hub/img/../assets/img/logo.png" alt="logo" class="company-logo">
         </div>
         <div class="job_listing-about">
            <div class="job_listing-position job_listing__column">
               <h3 class="job_listing-title">Driver</h3>
            </div>
            <div class="job_listing-location job_listing__column">
               <a class="google_map_link" href="http://maps.google.com/maps?q=Stoke-on-Trent&amp;zoom=14&amp;size=512x512&amp;maptype=roadmap&amp;sensor=false" target="_blank">Stoke-on-Trent</a>  
            </div>
            <ul class="job_listing-meta job_listing__column">
               <li class="apply"><a href="#" class="commonBtn">apply now</a></li>
               <li class="details"><a href="#" class="commonBtn">view details</a></li>
            </ul>
         </div>
      </li>
   </ul>
  </div>
</section>

<div class="top-footer">
  <div class="tendersRow">
    <div class="content cf">
      <ul>
        <li><a href="#"><span class="icon tenders"></span>10,000/ JOB </a></li>
        <li><a href="#"><span class="icon times"></span>5,000/ CANDIDATE APPLY</a></li>
        <li><a href="#"><span class="icon communicate"></span>5,000/ JOBS POSTED MONTHLY</a></li>
      </ul>
    </div>
  </div>
</div>

<?php /*if (!empty($userArr)) { ?>
  <?= $this->Html->link(__('Dashboard'),['controller'=>'dashboard','action'=>'index'],['class'=>'btn btn-primary btn-lg']);?>
  <?= $this->Html->link(__('Logout'),['controller'=>'users','action' => 'logout'],['class'=>'btn btn-primary btn-lg']);?>
<?php } else { ?>
  <?= $this->Html->link(__('Signup as Client'),['controller'=>'users','action' => 'registration','?'=>['user_type'=>'client']],['class'=>'btn btn-primary btn-lg']);?>
  <?= $this->Html->link(__('Signup as Driver'),['controller'=>'users','action' => 'registration','?'=>['user_type'=>'driver']],['class'=>'btn btn-primary btn-lg']);?>
  <?= $this->Html->link(__('Login'),['controller'=>'users','action' => 'login'],['class'=>'btn btn-primary btn-lg']);?>
<?php }*/ ?> 

<?php $this->append('bottom-script');?>
<script type="text/javascript">
</script>
<?php $this->end();?>