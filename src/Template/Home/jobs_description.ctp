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
<section id="container" class="job-description-wrapper">
  <div class="homeBanner">
    <div class="innerbanner">
      <h2 class="page-title text-center">Delivery Driver Wrexham</h2>
      <ul class="job-listing-meta meta">

        <li class="job-type full-time">full-time</li>

        <li class="location"><a class="google_map_link" href="http://maps.google.com/maps?q=Wrexham%2C+Wrexham%2C+Wales&amp;zoom=14&amp;size=512x512&amp;maptype=roadmap&amp;sensor=false" target="_blank">Wrexham, Wrexham, Wales</a></li>

        <li class="date-posted">Posted 2 months ago</li>
        <li class="job-company">
        Uber Eats </li>
      </ul>
    </div>
  </div>
  <div id="content" class="container content-area" role="main">
   <div class="job-overview-content row">
    <div class="job_listing-description job-overview col-md-10 col-sm-12">
     <h2 class="widget-title widget-title--job_listing-top job-overview-title">Overview</h2>
     <h3>As the face of UBER Eats out on the road in Wrexham, Delivery Drivers, whether in a car, on a motorbike or pushbike, get the opportunity to meet and talk to different customers at their homes every day. That’s why this role is about much more than just driving: it’s about helping others and delivering great service to customers in Wrexham, with a smile.</h3>
     <p>&nbsp;</p>
     <ul>
      <li><strong>Salary: £8.00 to £12.00 /hour.</strong></li>
      <li><strong>Full time, part time and flexible working hours</strong></li>
    </ul>
    <p>&nbsp;</p>
    <p>Its hands on, physical and full of variety. No two shifts are ever the same. For most of the day you’ll feel like your own boss, delivering to your customers but there is always a team of managers and colleagues ready to support you when you need them.</p>
    <p><strong>Delivery drivers in&nbsp;</strong><b>Wrexham: –</b></p>
    <ul>
      <li>To serve your customer’s with a smile &amp; take care of their deliveries as if they were your own;</li>
      <li>Load your car, motorbike or pushbike where required and do regular checks to make sure it’s road worthy;</li>
      <li>Represent the UBER Eats brand whilst on the Wrexham roads; and</li>
      <li>Drive safely, responsibly and within the law.</li>
    </ul>
    <p><strong>Delivery drivers in Wrexham will need: –</strong></p>
    <ul>
      <li>Bicycle / Pushbike</li>
      <li>Motorbike with CBT or full licence</li>
      <li>Car/Van with full driving licence</li>
    </ul>
    <p><strong>Wrexham </strong><strong>delivery drivers will need: –</strong></p>
    <ul>
      <li>EU/UK Driver’s Licence – Front and Back</li>
      <li>Bank statement – dated within last 3 months</li>
      <li>Certificate of Motor Insurance – Must cover food delivery or hire and reward not excluding food delivery</li>
    </ul>
    <p><strong>Delivery drivers in&nbsp;</strong><strong>Wrexham </strong><strong>will need to show: –</strong></p>
    <ul>
      <li>Proof of ID</li>
      <li>Proof of address</li>
      <li>Proof of licencing</li>
      <li>Proof of insurance</li>
    </ul>
  </div>
  <div class="job-meta col-md-2 col-sm-6 col-xs-12">
   <aside id="jobify_widget_job_company_logo-3" class="widget widget--job_listing jobify_widget_job_company_logo">
    <img class="company_logo jetpack-lazy-image jetpack-lazy-image--handled" src="/dev/drivers-hub/img/../assets/img/logo.png" alt="" data-lazy-loaded="1">

  </aside>
  <aside id="jobify_widget_job_apply-2" class="widget widget--job_listing jobify_widget_job_apply">
    <div class="job_application application">
     <a  class="application_button  commonBtn"  href="#apply-overlay"> Apply for job</a>

   </div>

 </aside>
</div>
</div>
</div>

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