<?php 
//date_default_timezone_set('Asia/Kolkata'); 
//echo date('Y-m-d H:i:s');
?>
<div class="top-content">          
  <div class="inner-bg">
      <div class="container">          
          <div class="row">
              <div class="registration-form">                
                <div class="form-box" style="margin-top: 30px">
                  <div class="form-top">
                    <div class="form-top-left">
                      <h3>OTP verification</h3>
                        <p>Enter your otp:</p>
                    </div>
                    <div class="form-top-right">
                      <i class="fa fa-pencil"></i>
                    </div>
                  </div>                  
                  <div class="form-bottom">
                    <?= $this->Flash->render(); ?>
                    <?= $this->Flash->render('auth'); ?>
                    <?= $this->Form->create('validateOtp',['id'=>'validateOtp','class' => 'validateOtp','autocomplete'=>'off']); ?>
                      <div class="row">
                        <div class="col-md-7 veriotptimer">
                          <?= $this->Form->control('otp', ['type'=>'text', 'class'=>'form-control', 'maxlength'=>'5', 'placeholder'=>'Enter One Time Password', 'title'=>'OTP is required', 'autocomplete'=>'off', 'required'=>true, 'label'=>false]); ?>
                          <span id="otptimer"></span>
                        </div>
                        <div class="col-md-5 bottom-buttom-section">
                          <?php echo $this->Form->button('<i class="fa fa-thumbs-o-up"></i> Verify OTP', ['type'=>'submit', 'id'=>'submit-btn', 'class'=> 'otpbtn']); ?>
                        </div>
                      </div>
                    <?= $this->Form->end(); ?>                  
                  <?php if($repeats > 1){ ?>
                    <p style="color: #19b9e7;">Oops! you have reached OTP limit. Please verify OTP or Click on Cancel button to start new registration.</p>

                <?php } if($repeats < 2){ ?>
                  <p style="color: #19b9e7;">If you did not receive OTP(One Time Password) via SMS/Email. You can</p>
                  <div class="clearfix"></div>
                  <?= $this->Form->create('resendOtp', ['url' => ['controller' => 'registration', 'action' => 'resendOtp'],'id' => 'registerform','type'=>'post','class' => 'form-horizontal', 'style'=>'display:inline-block;']); ?>
                    <input name="id" type="hidden" id="otp_id" value="<?php echo $this->request->getSession()->read('otpId'); ?>" />
                    <?php echo $this->Form->button('<i class="fa  fa-repeat"></i> Re - send OTP', ['type'=>'submit', 'id'=>'resend_otp', 'class'=> 'resetbutton']); ?>
                <?= $this->Form->end(); ?>
                <?php } ?>
                <?php echo $this->Form->create('restart_reg', ['url' => ['controller' => 'registration', 'action' => 'restartRegistration'],'type'=>'post','class' => 'form-horizontal', 'style'=>'display:inline-block; float:right;']); ?>
                  <?php echo $this->Form->button('<i class="fa fa-times" aria-hidden="true"></i> Cancel', ['type' => 'submit', 'id'=>'submit-btn', 'class'=> 'btn reset kill', 'title'=>'Click to start new registration.']) ?>
                <?php echo $this->Form->end(); ?>
                <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>          
      </div>
    </div>  
</div>
<style type="text/css">
#validateOtp input.form-control {
    width: 100%;
}
</style>
<?php $this->append('bottom-script');?>
<script type="text/javascript">

$(document).ready(function(){
  var validator = $("#validateOtp").validate({
    rules: {                   
      otp :{
        required: true,
      },
    },                             
    messages: {
      otp : {
        required: " Enter OTP",
      },
    }
  });
});


  var baseUrls = "<?php echo $this->Url->build('/registration', true);?>";
  function n(n){
    return n > 9 ? "" + n: "0" + n;
  }
  var d = "<?php echo date('M d, Y H:i:s', $this->request->getSession()->read('otp_time'));?>";
  var countDownDate = new Date(d).getTime();

  var x = setInterval(function() {
    var now = new Date().getTime();    
    var distance = countDownDate - now;
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("otptimer").innerHTML = n(minutes) + ":" + n(seconds);
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("otptimer").innerHTML ='00:00';
      //location.href= baseUrls+"/expireotp";
    }
  }, 1000);

  $('.resetbutton, .otpbtn, .kill').click(function(){
    clearInterval(x);
  });
</script>
<?php $this->end(); ?>