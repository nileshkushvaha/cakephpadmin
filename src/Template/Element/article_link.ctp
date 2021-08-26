<?php
use Cake\Routing\Router;

if (!empty($article_link)) {
foreach ($article_link as $key => $_article_links) {
  	$isShow  = false;
  	$link    = '';
  	if ($_article_links->redirection == 'new-window') {
    	$target = '_blank';
  	} else {
    	$target = '_self';
  	}
  	if(in_array($_article_links->link_type, $linkType) && !is_null($_article_links->link_type)){
    	$isShow  = true;
    	$lOption = ['controller' => $_article_links->link_type.'s','action'=>'page','id'=> $_article_links->object_id,];
    	$link = Router::url($lOption, ['pass' => ['id'], '_full' => true]);
  	} else if (!empty($_article_links->custom_link)) {
    	$isShow = true;
    	$cUrl = $_article_links->custom_link;
    	if (filter_var($cUrl, FILTER_VALIDATE_URL)) {
      		$link = $cUrl;
    	} else {
      		$link = '#';
    	}
    } else if (!empty($_article_links->internal_link)) {
        $isShow = true;
        $lbption = ['prfix'=> false,'controller'=>$_article_links->internal_link];
        $link = Router::url($lbption, ['_full' => true]);
		}
		if($_article_links->link_title == 'Complaints / Grievance Redressal'){
			$_article_links->link_title = 'Online Complaints / Grievance Redressal';
		}
  	if ($isShow) { ?>        
      <div class="co-md-4 col-sm-4">
        <div class="box-4"><a title="<?=$_article_links->link_title?>" href="<?=$link?>" target="_blank"><i class="fa fa-tasks" aria-hidden="true"></i> <span><?=$_article_links->link_title?></span></a></div>
      </div>        
  	<?php }
} 
} ?>