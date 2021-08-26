<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \December 5, 2018, 4:57 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Swavlamban $swavlamban
 */
/* $this->assign('title',$swavlamban->title);
$this->Breadcrumbs->add(__($swavlamban->title)); */
?>


<?= $this->Html->css(['../assets/css/lightgallery.css','../assets/css/lg-transitions.css']); ?>
  <section class="inner-top wow fadeInDown hide">
   
    <div class="breadcrumb-inner">
      <div class="container">
        <div class="row">
          <div class="col-md-12 wow fadeInDown">
            <div id="breadcrumb">
              <?= $this->element('breadcrumb'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ./section -->
  
  <section class="inner-section-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="over-cont wow fadeInDown">
            
             <h2><?= "Press Coverage"; ?></h2>
			 <h4><?= $press_cate->title; ?></h4>
            
            <?php if (!empty($gal_photos)) { ?>
              <div class="demo-gallery">
			 
                <ul id="lightgallery" class="list-unstyled row">
                  <?php foreach ($gal_photos as $key => $_galleries) { ?>
                    <li class="col-xs-6 col-sm-4 col-md-3" data-src="<?= $this->Url->build('/files/pressCoverages/'. $_galleries->filename);?>" data-sub-html="<h4><?=$_galleries->filename?></h4>">
					
					<div class="pc-box-title">
                        <a href="">
                            <img class="img-responsive" src="<?= $this->Url->build('/files/pressCoverages/'. $_galleries->filename);?>">
                            <div class="demo-gallery-poster">
                              <img src="<?= $this->Url->build('/assets/images/zoom.png');?>">
                            </div>
                        </a>
					</div>
						  
						 <div class="edition-pub"> <?= $_galleries['press_edition']?> &nbsp;<?= $_galleries['press_publication']?></div>
									<div class="date-pc"><?= date('d-m-Y',strtotime($_galleries['release_date']));?></div>
                    </li>
                  
                    <?php } ?>                  
                </ul>
				
              </div>
              <?php } ?>
              
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="clearfix"></div>
  <?php $this->Html->script(['../assets/js/lightgallery.js','../assets/js/lg-zoom.js','../assets/js/lg-autoplay.js','../assets/js/lg-thumbnail.js','../assets/js/lg-fullscreen.js','../assets/js/lg-hash.js'],['block' => 'bottom-script']); ?>
<?php $this->append('bottom-script');?>
  <script type="text/javascript">
    /*$('#zoom-gallery').magnificPopup({
      delegate: 'a',
      type: 'image',
      closeOnContentClick: false,
      closeBtnInside: false,
      mainClass: 'mfp-with-zoom mfp-img-mobile',
      image: {
        verticalFit: true,        
      },
      gallery: {
        enabled: true
      },
      zoom: {
        enabled: true,
        duration: 300, // don't foget to change the duration also in CSS
        opener: function(element) {
          return element.find('img');
        }
      }      
    });*/
    $(document).ready(function() {
        $("#lightgallery").lightGallery(); 
    });
  </script>
  <?php $this->end();?>
  <style type="text/css">
    .image-source-link {
      color: #98C3D1;
    }
    .mfp-wrap {
      z-index: 99991043;
    }
    .mfp-with-zoom .mfp-container,
    .mfp-with-zoom.mfp-bg {
      opacity: 0;
      -webkit-backface-visibility: hidden;
      /* ideally, transition speed should match zoom duration */
      -webkit-transition: all 0.3s ease-out; 
      -moz-transition: all 0.3s ease-out; 
      -o-transition: all 0.3s ease-out; 
      transition: all 0.3s ease-out;
    }
    .mfp-with-zoom.mfp-ready .mfp-container {
      opacity: 1;
    }
    .mfp-with-zoom.mfp-ready.mfp-bg {
      opacity: 0.8;
      z-index: 999999;
    }
    .mfp-with-zoom.mfp-removing .mfp-container, 
    .mfp-with-zoom.mfp-removing.mfp-bg {
      opacity: 0;
    }
  </style>