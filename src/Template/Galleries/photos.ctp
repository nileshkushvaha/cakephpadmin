<?php
$this->assign('title',__($title));
$this->assign('subtitle',__($title));
$this->Breadcrumbs->add(__($title));

$this->Html->meta('keywords', $title, ['block' => true]);
$this->Html->meta('description', $title, ['block' => true]);


$gallery_category_id = isset($gallery_category_id) ? $gallery_category_id : '';
$fromdate = isset($fromdate) ? date('m/d/Y',strtotime($fromdate)) : '';
$todate = isset($todate) ? date('m/d/Y',strtotime($todate)) : '';
$title1 = isset($title1) ? $title1 : '';
?>

<div class="inner-main-sec">
    <div class="container">
        <div class="search-bar w3-animate-bottom filter-dta">
            <section class="search-sec ">
                <?php echo $this->Form->create('officersearch', ['id' => 'gallery', 'type' => 'post']); ?> 
                <div class="row">
                    <div class="col-xs-12">
                        <div class="search-kyword title-keyword">
                            <?php echo $this->Form->input('title', ['value' => $title1, 'label' => false, 'maxlength' => '255', 'placeholder' => 'Enter Title', 'class' => 'form-control search-slt']); ?>
                        </div>
                        <div class="select-box-t " >
                            <?= $this->Form->control('gallery_category_id', ['options' => $galleryCategories, 'id' => 'speed2', 'label' => false, 'value' => $gallery_category_id,'empty'=>'Select Category']); ?>
                        </div>
                        <div class="calender-div-s calender-t"> <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $this->Form->input('fromdate', ['value' => $fromdate, 'label' => false,'id'=>'datepicker3', 'maxlength' => '255', 'placeholder' => 'Enter From Date', 'class' => 'form-control']); ?>
                        </div>
                        <div class="calender-div-s calender-t"> <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $this->Form->input('todate', ['value' => $todate, 'label' => false,'id'=>'datepicker4', 'maxlength' => '255', 'placeholder' => 'Enter To Date', 'class' => 'form-control']); ?>
                        </div>
                        <div class="select-box-btn" >
                            <button type="submit" class="btn btn-danger wrn-btn">Search</button>
                        </div>
                        <div class="select-box-btn reset" >
                            <a href="/startup_haryana/galleries/photos" class="btn btn-danger wrn-btn">Reset</a>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </section>
        </div>

        <div class="clearfix"></div>
        <div class="interview-sectionst discussion demo-gallery">
            <ul class="light-gallery">                      
                <?php foreach ($gal_photos as $key => $_galleries) { ?>                        
                    <li class="col-xs-6 col-sm-4 col-md-3" data-src="<?= $this->Url->build('/files/galleries/' . $_galleries->filename); ?>" data-sub-html="<h4><?= $_galleries->filename ?></h4>"> 
                        <span class="date-st">
                            <span class="date-display-single" property="dc:date" datatype="xsd:dateTime" content="2017-03-30T00:00:00+05:30"><?= date('d-M-Y', strtotime($_galleries->created)); ?></span>

                        </span> 
                        <div class="image_tn">
                            <a href="<?= $this->Url->build('/files/galleries/' . $_galleries->filename); ?>" data-showsocial="true" data-thumbnail="<?= $this->Url->build('/files/galleries/' . $_galleries->filename); ?>" class="html5lightbox" data-group="set1" title="<?= $_galleries->title?>">                                    
                                <img src="<?= $this->Url->build('/files/galleries/' . $_galleries->filename); ?>"  alt="" > 
                                 <span class="video-gallery">
                                    <i class="fa fa-search"></i>
                                </span>
                            </a>
                        </div>                        
                        <div class="sample-stc">
                            <h3 class="equalheight" style="height: 32px;"><?= $_galleries->title; ?></h3>
                        </div>
                        <div class="photos-sec-div vidoe-part-stmst">
                            <ul class="light-gallery-photo">
                                <li> <?= $_galleries->filemime; ?></li>
                                <li><i class="fa fa-file-text-o"></i> <?= $this->OptionsData->formatSizeUnits($_galleries->filesize); ?></li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>         
            </ul>
        </div>
        <?php  $paginatorInformation = $this->Paginator->params();
        $totalPageCount = $paginatorInformation['page'];
        if ($totalPageCount>0) { ?>
        <ul class="pagination pagination-md no-margin">
          <?= $this->Paginator->first('<<') ?>
          <?= $this->Paginator->prev('<') ?>
          <?= $this->Paginator->numbers() ?>
          <?= $this->Paginator->next('>') ?>
          <?= $this->Paginator->last('>>') ?>
        </ul>
      <?php } ?>
    </div>
</div>


<style>
    .html5-playpause {
    display: none !important;
}
</style>
<?= $this->Html->css(['../assets/css/lightcss.css']); ?>
<?php $this->append('bottom-script'); ?>
<script type="text/javascript">
    $(document).ready(function () {        
        $("#datepicker4").datepicker();
        $("#datepicker3").datepicker();
    });    
</script>
<?php $this->Html->script(['../assets/js/html5highlight.js', '../assets/js/html5lightbox.js'], ['block' => 'bottom-script']); ?>
<?php $this->Html->css(['AdminLTE./plugins/datepicker/datepicker3'], ['block' => 'head-style']); ?>
<?php $this->Html->script(['AdminLTE./plugins/datepicker/bootstrap-datepicker'], ['block' => 'bottom-script']); ?>
<?php $this->end(); ?>