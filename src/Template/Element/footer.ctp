<?php
/**
 * Element : Footer
 * Controll all footer content.
 * @author : Nilesh Kushvaha
 * @version : 1.1
 * @since : 24 June 2020
 */
use Cake\Core\Configure;
?>
</main>
<footer>
	<!--? Footer Start-->
	<div class="footer-area section-bg">
		<div class="container">
			<div class="footer-top footer-padding">
				<div class="row d-flex justify-content-between">
					<div class="col-xl-4 col-lg-4 col-md-5 col-sm-8">
						<div class="single-footer-caption mb-50">
							<div class="footer-logo logo">
								<?=$this->Html->image("../assets/img/logo_new.png",["alt"=>"logo"])?>
							</div>
							<p>
								<span>Call us</span><br/>
								<a href="tel:9009999990">900 999 99 90</a>
							</p>
							<p>58 Howard Street #2 San Francisco</p>
							<p>
								<a href="mailto:contact@shoeindex.com">contact@shoeindex.com</a>
							</p>
						</div>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-5 col-sm-6">
						<div class="single-footer-caption mb-50">
							<div class="footer-tittle">
								<h4>Navigation</h4>
								<ul>
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">How It Works</a></li>
									<li><a href="#">Team</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-5 col-sm-6">
						<div class="single-footer-caption mb-50">
							<div class="footer-tittle">
								<h4>Useful Links</h4>
								<ul>
									<li><a href="#">Registration</a></li>
									<li><a href="#">Login</a></li>
									<li><a href="#">Policy</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- Instagram -->
					<div class="col-xl-4 col-lg-4 col-md-5 col-sm-7">
						<div class="single-footer-caption mb-50">
							<div class="footer-tittle">
								<h4>Follow Us</h4>
							</div>
							<div class="social-share">
								<ul style="list-style: none;">
									<li><a href="#" target="_blank" class="button__facebook"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#" target="_blank" class="button__twitter">
										<i class="fab fa-twitter"></i>
									</a></li>
									<li><a href="#" target="_blank" class="button__twitter">
										<i class="fab fa-linkedin"></i>
									</a></li>
									<li><a href="#" target="_blank" class="button__twitter">
										<i class="fab fa-youtube"></i>
									</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex justify-content-between align-items-center">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="footer-copy-right">
							Copyright © <?=date('Y')?> <?= Configure::read('Theme.title'); ?>.  All rights reserved.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer End-->
</footer>
<!-- Scroll Up -->
<div id="back-top" >
	<a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>