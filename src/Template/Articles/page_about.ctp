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
use Cake\Core\Configure;
$lang = 'en';
if ($Configure::check('language')) {
  $lang = $Configure::read('language.culture');
}
?>

<!-- ================ about section start ================= -->
<section class="about-section">
  <div class="container">
    <div class="row row-pb-lg align-items-center about-top-section">
      <div class="col-lg-6">
        <div class="images">
          <?=$this->Html->image("../assets/img/about.jpg",["alt"=>"logo","class"=>"img-fluid"])?>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="about-wrap">
          <h2>About Shoeindex</h2>
          <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
          <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="top-content-wrapper bg-white">
    <div class="container">
      <h2>We provide and extend personalized & innovative healthcare services to its customers.
      </h2>
      <p>
        We have recently organised a new office location at 33 Queens Square, Leeds to cater for the growth of business for North of UK and Scotland locations. 
      </p>
    </div>
  </div>
  <div class="about-team-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="box-content-wrapper">
            <div class="icon-box-wrapper">
              <div class="medizin-icon-wrap">
                <div class="medizin-icon-view">
                  <div class="medizin-icon icon medizin-svg-icon medizin-solid-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" xml:space="preserve">
                      <path fill="none" stroke="url(#svg-gradient5f0092ece4a94)" stroke-width="2" stroke-miterlimit="10" d="M3.7079999999999984,35A28.292,28.292 0,1,1 60.292,35A28.292,28.292 0,1,1 3.7079999999999984,35" style="stroke-dasharray: 178, 180; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece4a94)" stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" d="M37,40L45,21L26,29L19,47Z" style="stroke-dasharray: 80, 82; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece4a94)" stroke-width="2" stroke-miterlimit="10" d="M26,29L37,40" style="stroke-dasharray: 16, 18; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece4a94)" stroke-width="2" stroke-miterlimit="10" d="M36.9,7C36.965,6.677,37,6.342,37,6  c0-2.761-2.239-5-5-5s-5,2.239-5,5c0,0.342,0.035,0.677,0.1,1" style="stroke-dasharray: 18, 20; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece4a94)" stroke-width="2" stroke-miterlimit="10" d="M32,7L32,12" style="stroke-dasharray: 5, 7; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece4a94)" stroke-width="2" stroke-miterlimit="10" d="M32,58L32,63" style="stroke-dasharray: 5, 7; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece4a94)" stroke-width="2" stroke-miterlimit="10" d="M60,35L55,35" style="stroke-dasharray: 5, 7; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece4a94)" stroke-width="2" stroke-miterlimit="10" d="M9,35L4,35" style="stroke-dasharray: 5, 7; stroke-dashoffset: 0;"></path>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="icon-box-content">
                <div class="heading-wrap">
                  <h3 class="heading">Our Vision</h3>
                </div>
                <div class="description-wrap">
                  <div class="description">
                    <ul class="list-style-dots">
                      <li>Good Service</li>
                      <li>For Community</li>
                      <li>Long Term Development</li>
                      <li>Save Our Planet</li>
                      <li>Help People</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box-content-wrapper">
            <div class="icon-box-wrapper">
              <div class="medizin-icon-wrap">
                <div class="medizin-icon-view">
                  <div class="medizin-icon icon medizin-svg-icon medizin-solid-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" xml:space="preserve">
                      <path fill="none" stroke="url(#svg-gradient5f0092ece69a4)" stroke-width="2" stroke-miterlimit="10" d="M7,0L7,64" style="stroke-dasharray: 64, 66; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece69a4)" stroke-width="2" stroke-miterlimit="10" d="M32.062,6L26,11L26,35L57,35L51,23L57,11L26,11" style="stroke-dasharray: 121, 123; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece69a4)" stroke-width="2" stroke-miterlimit="10" d="M26,30L7,30L7,6L32,6L32,11" style="stroke-dasharray: 73, 75; stroke-dashoffset: 0;"></path>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="icon-box-content">
                <div class="heading-wrap">
                  <h3 class="heading">Our Promise</h3>
                </div>
                <div class="description-wrap">
                  <div class="description">
                    <ul class="list-style-dots">
                      <li>Sustainable Relationship</li>
                      <li>Renew Commitment</li>
                      <li>Provide The Best Solution</li>
                      <li>Profitable Relationship</li>
                      <li>Adapt With People's Needs</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box-content-wrapper">
            <div class="icon-box-wrapper">
              <div class="medizin-icon-wrap">
                <div class="medizin-icon-view">
                  <div class="medizin-icon icon medizin-svg-icon medizin-solid-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" xml:space="preserve">
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M1,32A31,31 0,1,1 63,32A31,31 0,1,1 1,32" style="stroke-dasharray: 195, 197; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M17,32A15,15 0,1,1 47,32A15,15 0,1,1 17,32" style="stroke-dasharray: 95, 97; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M26,18L26,1" style="stroke-dasharray: 17, 19; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M38,18L38,1" style="stroke-dasharray: 17, 19; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M26,63L26,46" style="stroke-dasharray: 17, 19; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M38,63L38,46" style="stroke-dasharray: 17, 19; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M46,26L63,26" style="stroke-dasharray: 17, 19; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M46,38L63,38" style="stroke-dasharray: 17, 19; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M1,26L18,26" style="stroke-dasharray: 17, 19; stroke-dashoffset: 0;"></path>
                      <path fill="none" stroke="url(#svg-gradient5f0092ece8ac9)" stroke-width="2" stroke-miterlimit="10" d="M1,38L18,38" style="stroke-dasharray: 17, 19; stroke-dashoffset: 0;"></path>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="icon-box-content">
                <div class="heading-wrap">
                  <h3 class="heading">Our Mision</h3>
                </div>
                <div class="description-wrap">
                  <div class="description">
                    <ul class="list-style-dots">
                      <li>Change The Habits</li>
                      <li>Best Quality</li>
                      <li>Think Big Do Bigger</li>
                      <li>Stablity &amp; competence</li>
                      <li>Safer &amp; Better Life</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ================ about section end ================= -->

<?php $this->append('bottom-script');?>
<script type="text/javascript">

</script>
<?php $this->end();?>