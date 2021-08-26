<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \December 5, 2018, 4:57 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News $news
 */
$this->assign('title',__('News'));
$this->assign('subtitle',__('News'));
$this->Breadcrumbs->add(__('News'));

$this->Html->meta('keywords', 'News', ['block' => true]);
$this->Html->meta('description', "News", ['block' => true]);

?>  

<div class="inner-main-sec">
  <div class="container">
    <div class="section-upcoming-events">
      <div class="row">
        <div class="sec-title-style1 text-center max-width">
          <div class="title">Latest From Our Newsletter</div>
          <div class="text clr-yellow">
            <div class="decor-left"><span></span></div><p>News &amp; Updates</p>
            <div class="decor-right"><span></span></div>
          </div>
        </div>
      </div>

      <div class="row">
        <?php foreach ($news as $key => $newsValue) {
          $newsOption = ['prefix' => false,'controller' => 'News','action'=>'page','id'=> $newsValue['id']];
          $newsLink = $this->Url->build($newsOption, ['pass'=>['id'],'fullBase' => true]);?>
          <div class="col-sm-4 ">
            <div class="section-content "> 
              <div class="event-image">
                <?php if (!empty($newsValue['header_image'])) {
                  echo $this->Html->image("/files/news/".$newsValue['header_image'],["alt"=>$newsValue['title'],'class'=>'img-responsive']);
                } else {
                  echo $this->Html->image("/files/news/news_placeholder.jpg",["alt"=>"news-placeholder",'class'=>'img-responsive']);
                }?>
              </div>
              <div class="date">
                <a href="<?=$newsLink?>">
                  <span class="day"><?= date('d', strtotime($newsValue['display_date']))?></span>
                  <span class="month"><?= date('M', strtotime($newsValue['display_date']))?></span>
                  <span class="year"><?= date('Y', strtotime($newsValue['display_date']))?></span>
                </a>
              </div>
              <div class="content-sec upcomming-event-sec">
                <h5> <?= $this->Html->link($newsValue['title'], $newsLink, ['escape'=>false]);?></h5>
                <p><?=$newsValue['excerpt']?></p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php  $paginatorInformation = $this->Paginator->params();
        $totalPageCount = $paginatorInformation['page'];
        if ($totalPageCount>1) { ?>
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
</div>