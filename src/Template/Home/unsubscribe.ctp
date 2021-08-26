<div class="top-content">          
	<div class="inner-bg">
		<?php echo $this->Form->create('Newsletter',array('url'=>array('controller'=>'home','action'=>'unsubscribe')));?>
			<div class="container">          
				<div class="row">
					<div class="registration-form">                
						<div class="form-box" style="margin-top: 0;">
							<h3>You will be missed</h3>
							you are unsubscribing from the SIDBI Email list.
							Please take a moment to tell us why you no longer wish to hear from us :
							<div class="form-group">
								<div class="radio">
									<label><input type="radio" name="reason" value="I am not comfertable with SIDBI" checked>I am not comfertable with SIDBI.</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="reason" value="I receive too many emails from SIDBI">I receive too many emails from SIDBI.</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="reason" value="I am having difficulty receiving or viewing email from SIDBI">I am having difficulty receiving or viewing email from SIDBI.</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="reason" value="I don't think the content is relevant">I don't think the content is relevant.</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="reason" value="I don't remember subscribing to receive emails from SIDBI">I don't remember subscribing to receive emails from SIDBI.</label>
								</div>
								<!--<div class="radio">
									<label><input type="radio" name="reason" value="other">Other (Please explain below)</label>
								</div>-->
							</div>
							<div class="form-group">
								<label for="email">Enter your email address</label>
								<?php echo $this->Form->input('email',array('placeholder'=>'Enter your valid email','label'=>false));?>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-default">Unsubscribe</button>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>