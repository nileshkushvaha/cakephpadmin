<ul>
  <?php 
  if (!empty($article->article_images)) {
    foreach ($article->article_images as $key => $_article_images) {
    if (!empty($_article_images->description)) { ?>
    <li>
      <?php if ($_article_images->filename) { ?>
        <a title="View" target="_blank" href="<?= $this->Url->build('/files/article/articlefiles/'. $_article_images->filename);?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?=$_article_images->description?></a> 
      <?php } ?>
    </li>
  <?php } }
  }?>
</ul>