<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @var \App\View\AppView $this
 */
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="owl-carousel owl-carousel1 owl-theme">
				<?php foreach ($logoSliderData as $key => $logoSliderValue) { ?>
					<div class="item" data-aos="zoom-in-up">  
						<?php if (empty($logoSliderValue['website'])) {
							echo $this->Html->image("/files/logo/".$logoSliderValue['logo_image'],["alt"=>$logoSliderValue['title'],"title"=>$logoSliderValue['title']]);
						} else {
							echo $this->Html->link($this->Html->image("/files/logo/".$logoSliderValue['logo_image'],["alt"=>$logoSliderValue['title'],"title"=>$logoSliderValue['title']]),$logoSliderValue['website'],['target' => '_blank','escape'=>false]);
						} ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>