<?php echo $this->Html->css('../assets/css/login'); ?>
<div class="top-content">          
  <div class="inner-bg">
      <div class="container">          
          <div class="row">
              <div class="registration-form">                
                <div class="form-box" style="margin-top:40px">
                  <div class="form-top">
                    <div class="form-top-left">
                      <h3>Sign up now</h3>
                        <p>Fill in the form below to get instant access:</p>
                    </div>
                    <div class="form-top-right">
                      <i class="fa fa-pencil"></i>
                    </div>
                  </div>                  
                  <div class="form-bottom">
                    <?= $this->Flash->render(); ?>
                    <?= $this->Flash->render('auth'); ?>
                    <?= $this->Form->create('registration',['id'=>'registration','class' => 'registration','autocomplete'=>'off']); ?>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" autocomplete="off" class="form-control" placeholder="Enter your email address">
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                        <input type="text" name="mobile_number" autocomplete="off" class="form-control" placeholder="Enter your mobile number">
                      </div>
                      <button type="submit" class="btn">Sign up</button>
                    <?= $this->Form->end(); ?>
                  </div>
                </div>
              
              <div class="social-login">
                <div class="social-login-buttons">
                  <?= $this->Html->link(__('Login'), ['prefix' => 'admin', 'controller'=>'Users','action' => 'login'],['class' =>'btn btn-link-2']) ?>
                  <?=  $this->Html->link(__('Forgot password'), ['prefix' => 'admin','controller'=>'Users', 'action' => 'forgotPassword'],['class' =>'btn btn-link-2']) ?>
                </div>
              </div>
            </div>
          </div>          
      </div>
    </div>  
</div>
<?php $this->append('bottom-script');?>
<script type="text/javascript">
  $(document).ready(function() {
    var baseUrls = "<?php echo $this->Url->build('/registration', true);?>";
      $("#registration").validate({
        onkeyup: false,
        rules:{
          email:{
            required: true,
            email: true,
            emailt : true,
            remote : {
              url: baseUrls + '/emailCheck',
              type: "post",
              beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
              }
            }
          },
          mobile_number:{
            required:true,
            mobileno:true,
            remote : {
              url: baseUrls + '/mobileexists',
              type: "post",
              beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
              }
            }
          },
        },
        messages:{
          email: {
            required: "Email is required.",
            email: "Please enter a valid email address.",
            emailt : 'Please enter a valid email address.',
            remote: "The email address you have entered is already exists with another account. Please try with another email."
          },
          mobile_number: {
            required: "Mobile number is required.",
            mobileno: "Please enter a valid Mobile Number.",
            remote: "The mobile number you entered already exists with another account. Please try with another number."
          }
        }
      });
  })

$.validator.addMethod("mobileno", function(value, element) {
  return this.optional(element) || /^(((\+){0,1}91|0)(\s){0,1}(){0,1}(\s){0,1}){0,1}[7-9][0-9](\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/.test(value);
}, "Please specify a valid mobile number");

$.validator.addMethod("emailt", function(value, element) {
  return this.optional(element) || /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test(value);
}, "Your entered invalid email id");
</script>
<?php $this->end(); ?>