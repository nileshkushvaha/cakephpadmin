<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $article
 */
use Cake\Routing\Router;
$this->assign('title','Search');
$this->Breadcrumbs->add(__('Search'));
$searchResult = !empty($searchResult)?$searchResult:0;
$productData =  !empty($productData)?$productData:0;
$tenderData = !empty($tenderData)?$tenderData:0;
$newsData = !empty($newsData)?$newsData:0;
$pressReleseData = !empty($pressReleseData)?$pressReleseData:0;
$articleData = !empty($articleData)?$articleData:0;
$announcementData = !empty($announcementData)?$announcementData:0;
$categories = isset($categories)?$categories:'';
if ($categories == 3) {
  $catSection = 'PressRelease';
}
?>
  <section class="share-holder wow fadeInDown ">
    <h2>Search Results</h2>
  </section>
  <!-- ./section -->
  <section class="inner-section-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">          
          <div class="over-cont wow fadeInDown">
            <?= $this->Flash->render(); ?>
          	<?= $this->Form->create('search',['id' => 'home-search-frm','class'=>'form-inline','type'=>'get','url' => ['action' => 'homeSearch']]); ?>
    				<!--<div class="form-group mb-2" id="searchBox">-->
    				<div class="form-group mb-2" id="searcBox">
              <input id="sText" type="text" class="form-control" name="searchkeyword" placeholder="Enter Keywords" value="<?=@$searchkeyword?>" size="60">
              <!--<div id="menu-container" style="position:absolute;"></div>-->
    				</div>
            <div class="form-group">
              <?= $this->Form->select('categories',$searchCategories,['id'=>'categoryId','empty'=>'Search all categories','value'=>$categories]);?>
            </div>
    				<input type="submit" value="Search" class="btn searchBtn" id="searchButton" onclick="return thisname();">
    			<?= $this->Form->end();?>
    			<hr>
          <?php if (!empty($searchResult)) { ?>
    			<div class="ml-2">
    				<h5><?=count($searchResult);?> results found !</h5>
    			</div>
    			<?php foreach ($searchResult as $key => $searchResultValue) {
    				$content = $this->Text->excerpt(strip_tags($searchResultValue['content']), $searchkeyword, 200, '...');?>
    				<div class="p-2">
    					<?php
              /*if (strtolower($catSection) == strtolower('products')) {
                $link = $this->Url->build('products');
              } else {
                $lOption = ['prefix'=>false,'controller'=>$catSection,'action'=>'page','id'=>$searchResultValue['id']];
                $link = $this->Url->build($lOption, ['pass' => ['id'], 'fullBase' => true]);
              }*/
              /*if (strtolower($catSection) == strtolower('products')) {
                $link = $this->Url->build('products');
              } else*/
              if(isset($searchResultValue['module'])) {
                if($searchResultValue['module']=='Announcements'){
                  $link = $this->Url->build('/announcements', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='BranchOffices'){
                  $link = $this->Url->build('/contact-us', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Careers'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'careers/page/'.$searchResultValue['id'].'', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Directors'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'directors', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Faqs'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'faqs', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Galleries'){
                  $link = $this->Url->build('/galleries/'.$searchResultValue['category'], ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Swavlambans'){
                  $link = $this->Url->build('/swavlambans/'.$searchResultValue['slug'].'', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='PressCoverages'){
                  $link = $this->Url->build('/galleries/press-coverage/'.$searchResultValue['category'].'', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Circulars'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'circulars', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='PublicationReports'){
                  $category = '';
                  if($searchResultValue['category']==1){
                    $category = 'annualSeries';
                  }elseif($searchResultValue['category']==2){
                    $category = 'msmeknowledge';
                  }elseif($searchResultValue['category']==3){
                    $category = 'msmepolicies';
                  }elseif($searchResultValue['category']==4){
                    $category = 'msmestudies';
                  }elseif($searchResultValue['category']==5){
                    $category = 'Annual Reports';
                  }elseif($searchResultValue['category']==6){
                    $category = 'Quarterly/Half-yearly Results';
                  }elseif($searchResultValue['category']==7){
                    $category = 'Corporate Governance';
                  }elseif($searchResultValue['category']==8){
                    $category = 'optimisms';
                  }elseif($searchResultValue['category']==9){
                    $category = 'sankalps';
                  }
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'publication-and-reports/'.$category.'', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='VideoGalleries'){
                    $link = $this->Url->build('/media#section4', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='PressRelease'){
                  $link = $this->Url->build('/media#section1', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='MsmeFocus'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'home#section8', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Tendor Document'){
                  //$lOption = ['prefix'=>false,'controller'=>'Tenders','action'=>'page','id'=>$searchResultValue['id']];
                  //$link = $this->Url->build($lOption, ['pass' => ['id'], 'fullBase' => true]);
                  //$lOption = ['prefix'=>false,'controller'=>'Tenders','action'=>'page','id'=>$searchResultValue['id']];
                  $link = $this->Url->build('/files/tenders/'.$searchResultValue['title'].'', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='EnquiryPage'){
                  $link = $this->Url->build('/online-enquiry', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='CareerPage'){
                  $link = $this->Url->build($searchResultValue['culture'].'/careers', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Contact Us Page'){
                  $link = $this->Url->build($searchResultValue['culture'].'/contact-us', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Cipos'){
                  $link = $this->Url->build('/cpios-orders/page/'.$searchResultValue['year'].'', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Circular'){
                  $link = $this->Url->build('/circulars', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Home'){
                  $link = $this->Url->build($searchResultValue['culture'].'/home', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='About'){
                  $link = $this->Url->build($searchResultValue['culture'].'/about-sidbi', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Board Of Directors'){
                  $link = $this->Url->build($searchResultValue['culture'].'/about-sidbi#section2', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Corporate Governance'){
                  $link = $this->Url->build($searchResultValue['culture'].'/corporate-governance', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Investors Relation'){
                  $link = $this->Url->build($searchResultValue['culture'].'/investors-relation', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Media'){
                  $link = $this->Url->build($searchResultValue['culture'].'/media', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='CCC'){
                  $link = $this->Url->build($searchResultValue['culture'].'/join-us-as-cccs', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Organization Chart'){
                  $link = $this->Url->build($searchResultValue['culture'].'/organization-chart', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Publication And Report'){
                  $link = $this->Url->build($searchResultValue['culture'].'/publication-and-reports', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Multilateral Agencies'){
                  $link = $this->Url->build($searchResultValue['culture'].'/multilateral-agencies', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Reservation Roster'){
                  $link = $this->Url->build($searchResultValue['culture'].'/reservation-rosters', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Complaint'){
                  $link = $this->Url->build($searchResultValue['culture'].'/online-enquiry/complaints', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Tenders'){
                  $link = $this->Url->build($searchResultValue['culture'].'/tenders', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='RTI'){
                  $link = $this->Url->build($searchResultValue['culture'].'/rti-cell', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='TC'){
                  $link = $this->Url->build($searchResultValue['culture'].'/terms-condition', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Privacy Policy'){
                  $link = $this->Url->build($searchResultValue['culture'].'/privacy-policy', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Copyright Policy'){
                  $link = $this->Url->build($searchResultValue['culture'].'/copyright-policy', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Hyperlinking Policy'){
                  $link = $this->Url->build($searchResultValue['culture'].'/hyperlinking-policy', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Accessibility'){
                  $link = $this->Url->build($searchResultValue['culture'].'/accessibility', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Disclaimer'){
                  $link = $this->Url->build($searchResultValue['culture'].'/disclaimer', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Evolution Of SIDBI'){
                  $link = $this->Url->build($searchResultValue['culture'].'/about-sidbi#section3', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Historical Journey'){
                  $link = $this->Url->build($searchResultValue['culture'].'/about-sidbi#section4', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Financial'){
                  $category = 'annualreports';
                  if($searchResultValue['category_id']==2){
                    $category = 'financialresults';
                  }
                  $link = $this->Url->build($searchResultValue['culture'].'/'.$category, ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Shareholding'){
                  $link = $this->Url->build($searchResultValue['culture'].'/about-sidbi#section6', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Fair Practices Code'){
                  $link = $this->Url->build($searchResultValue['culture'].'/fair-practices-code', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Fixed Deposit Scheme'){
                  $link = $this->Url->build($searchResultValue['culture'].'/investors-relation#section1', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Fixed Discount Bond'){
                  $link = $this->Url->build($searchResultValue['culture'].'/investors-relation#section2', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Press Releases'){
                  $link = $this->Url->build($searchResultValue['culture'].'/media#section1', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='News'){
                  $link = $this->Url->build($searchResultValue['culture'].'/media#section2', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Social Media'){
                  $link = $this->Url->build($searchResultValue['culture'].'/media#section3', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Video'){
                  $link = $this->Url->build($searchResultValue['culture'].'/media#section4', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Press Coverage'){
                  $link = $this->Url->build($searchResultValue['culture'].'/galleries/press-coverage/'.$searchResultValue['category'], ['fullBase' => true]);
                } elseif($searchResultValue['module']=='MicroCredits'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.$searchResultValue['micro_credit_category'].'', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='PressReleases'){
                  $link = $this->Url->build($searchResultValue['culture'].'/press-release/'.$searchResultValue['id'].'', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Testimonials'){
                  $texte = strtolower(str_replace(' ', '-', $searchResultValue['text']));
                  $text = str_replace(':','', $texte);
                  $link = $this->Url->build($searchResultValue['culture'].'/testimonials/'.$text.'', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Cipos Page'){
                  $link = $this->Url->build($searchResultValue['culture'].'/cpios-orders', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Whats Happening'){
                  $link = $this->Url->build($searchResultValue['culture'].'/announcements', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='MSME'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'home#section8', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='MSME Loan'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'products', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Structural Intervention'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'home#section5', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Ecosystem'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'/ecosystem', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='MSME PULSE'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'/msme-pulse', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Crisidex'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'/crisidex', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Venture Capital'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'/venture-capital', ['fullBase' => true]);
                } elseif($searchResultValue['module']=='Micro Finance'){
                  $link = $this->Url->build($searchResultValue['culture'].'/'.'/micro-finance', ['fullBase' => true]);
                }
              } elseif(isset($searchResultValue['catSection'])) {
                $lOption = ['prefix'=>false,'controller'=>$searchResultValue['catSection'],'action'=>'page','id'=>$searchResultValue['id']];
                $prelink = $this->Url->build($lOption, ['pass' => ['id'], 'fullBase' => true]);
                $explode = explode("/",$prelink);
                if($searchResultValue['culture']=='hi'){   $explode['3'] = 'hi';     }
                $link = implode("/",$explode);
              }
              ?>
    					<h4><?=$this->Html->link($searchResultValue['title'], $link, ['target' => '_blank']);?></h4>
              <!--<?php /*if (strtolower($catSection) == strtolower('products')) { ?>                
              <?php } else { ?>  
                <p class="text-primary h4"><?=$link?></p>
              <?php } */?> -->
              <p class="text-primary h4"><?=$link?></p>
    					<p><?php echo $this->Text->highlight($content,
    					    $searchkeyword,
    					    ['format' => '<span class="highlight">\1</span>','html' => false]
    					); ?></p>
    					<hr>
    				</div>
      			<?php } 
            } elseif (!empty($productData) || !empty($tenderData) || !empty($newsData) || !empty($pressReleseData) ) { ?>
              <div class="ml-2">
                <h5><?=count($productData) + count($tenderData) + count($newsData) + count($pressReleseData) + count($articleData);?> results found !</h5>
              </div>
              <?php if (!empty($productData)) {
                foreach ($productData as $key => $productDataValue) {
                  $content = $this->Text->excerpt(strip_tags($productDataValue['content']), $searchkeyword, 200, '...');?>
                  <div class="p-2">
                    <?php
                      $lOption = ['prefix'=>false,'controller'=>'Products','action'=>'page','id'=>$productDataValue['id']];
                      $link = $this->Url->build('products');
                    ?>
                    <h4><?=$this->Html->link($productDataValue['title'], $link, ['target' => '_blank']);?></h4>
                    <!-- <p class="text-primary h4"><?=$link?></p> -->
                    <p><?php echo $this->Text->highlight($content,
                        $searchkeyword,
                        ['format' => '<span class="highlight">\1</span>','html' => false]
                    ); ?></p>
                    <hr>
                  </div>
                <?php } 
              } 
              if (!empty($tenderData)) {
                foreach ($tenderData as $key => $tenderDataValue) {
                $content = $this->Text->excerpt(strip_tags($tenderDataValue['content']), $searchkeyword, 200, '...');?>
                <div class="p-2">
                  <?php
                    $lOption = ['prefix'=>false,'controller'=>'Tenders','action'=>'page','id'=>$tenderDataValue['id']];
                    $link = $this->Url->build($lOption, ['pass' => ['id'], 'fullBase' => true]);
                  ?>
                  <h4><?=$this->Html->link($tenderDataValue['title'], $link, ['target' => '_blank']);?></h4>
                  <p class="text-primary h4"><?=$link?></p>
                  <p><?php echo $this->Text->highlight($content,
                      $searchkeyword,
                      ['format' => '<span class="highlight">\1</span>','html' => false]
                  ); ?></p>
                  <hr>
                </div>
                <?php } 
              } 
              if (!empty($newsData)) {
                foreach ($newsData as $key => $newsDataValue) {
                $content = $this->Text->excerpt(strip_tags($newsDataValue['content']), $searchkeyword, 200, '...');?>
                <div class="p-2">
                  <?php
                    $lOption = ['prefix'=>false,'controller'=>'News','action'=>'page','id'=>$newsDataValue['id']];
                    $link = $this->Url->build($lOption, ['pass' => ['id'], 'fullBase' => true]);
                  ?>
                  <h4><?=$this->Html->link($newsDataValue['title'], $link, ['target' => '_blank']);?></h4>
                  <p class="text-primary h4"><?=$link?></p>
                  <p><?php echo $this->Text->highlight($content,
                      $searchkeyword,
                      ['format' => '<span class="highlight">\1</span>','html' => false]
                  ); ?></p>
                  <hr>
                </div>
                <?php } 
              } 
              if (!empty($pressReleseData)) {
                foreach ($pressReleseData as $key => $pressReleseDataValue) {
                $content = $this->Text->excerpt(strip_tags($pressReleseDataValue['content']), $searchkeyword, 200, '...');?>
                <div class="p-2">
                  <?php
                    $lOption = ['prefix'=>false,'controller'=>'PressRelease','action'=>'page','id'=>$pressReleseDataValue['id']];
                    $link = $this->Url->build($lOption, ['pass' => ['id'], 'fullBase' => true]);
                  ?>
                  <h4><?=$this->Html->link($pressReleseDataValue['title'], $link, ['target' => '_blank']);?></h4>
                  <p class="text-primary h4"><?=$link?></p>
                  <p><?php echo $this->Text->highlight($content,
                      $searchkeyword,
                      ['format' => '<span class="highlight">\1</span>','html' => false]
                  ); ?></p>
                  <hr>
                </div>
                <?php } 
              } 
              if (!empty($articleData)) {
                foreach ($articleData as $key => $articleDataValue) {
                $content = $this->Text->excerpt(strip_tags($articleDataValue['content']), $searchkeyword, 200, '...');?>
                <div class="p-2">
                  <?php
                    $lOption = ['prefix'=>false,'controller'=>'articles','action'=>'page','id'=>$articleDataValue['id']];
                    $link = $this->Url->build($lOption, ['pass' => ['id'], 'fullBase' => true]);
                  ?>
                  <h4><?=$this->Html->link($articleDataValue['title'], $link, ['target' => '_blank']);?></h4>
                  <p class="text-primary h4"><?=$link?></p>
                  <p><?php echo $this->Text->highlight($content,
                      $searchkeyword,
                      ['format' => '<span class="highlight">\1</span>','html' => false]
                  ); ?></p>
                  <hr>
                </div>
                <?php } 
              }
            } else { ?>
              <div class="ml-2">
                <h5>No results found !</h5>
              </div>
            <?php } ?>
           
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="clearfix"></div>
<style type="text/css">
  .p-2 {
      padding: .5rem!important;
  }	
  #searchPage p.h4 {
      padding-top: 10px;
  }
  .highlight {
      padding: .2em;
      background-color: #fcf8e3;
  }
  .text-primary {
      color: #007bff!important;
  }
  #searchPage p+.searchPara {
      color: #000;
      font-size: 15px;
      line-height: 24px;
      word-spacing: 2px;
  }
  .ui-autocomplete {
      max-height: 200px;
      overflow-y: auto;
      /* prevent horizontal scrollbar */
      overflow-x: hidden;
      /* add padding to account for vertical scrollbar */
      padding-right: 20px;
      width: 650px;
  } 
</style>
<?php $this->append('bottom-script');?>
<script type="text/javascript">
	function thisname(){
		var searchvalue = $("#sText").val();
		if(searchvalue == ''){
			return false;
		}
	}

  $('#sText').keyup(function (e) {
    var yourInput = $(this).val();
    re = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar){
      var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
      alert('Special characters are not allowed.')
      $(this).val(no_spl_char);
    }
  });
</script>
<?php $this->end();?>
<script>
  $('#sText').autocomplete({
      //source:'<?php /*echo Router::url(array('controller' => 'Home', 'action' => 'getSuggestiveSearch'));*/ ?>',
      source: function(request, response) {
            $.ajax({
                url: '<?php echo Router::url(array('controller' => 'Home', 'action' => 'getSuggestiveSearch')); ?>',
                dataType: "json",
                data: {
                  term : request.term,
                  category_id : $("#categoryId").val()
                },
                success: function(data) {
                  response(data);
                }
            });
        },
      minLength: 3,
  });
</script>