<?php
use Cake\Core\Configure;
?>
<div class="top-content">          
  <div class="inner-bg">
      <div class="container">          
          <div class="row">
              <div class="registration-form">                
                <div class="form-box" style="margin-top: 0;">
                  <div class="form-top">
                    <div class="form-top-left">
                      <h3>Login to  <?= Configure::read('Theme.title'); ?></h3>
                        <p>Enter email and password to log on:</p>
                    </div>
                    <div class="form-top-right">
                      <i class="fa fa-lock"></i>
                    </div>
                  </div>                  
                  <div class="form-bottom">
                    <?= $this->Flash->render(); ?>
                    <?= $this->Flash->render('auth'); ?>
                    <?php echo $this->Form->create('loginform',['id' => 'loginform','autocomplete' => 'off']); ?>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" autocomplete="off" class="form-control" placeholder="Enter your email address">
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Enter your password">
                      </div>
                      <?php $captcha = $this->Captcha->create('securitycode', [
                        'type'         => 'image', //or 'math'
                        'theme'        => 'login',
                        'controller'   => 'Users',
                        'action'       => 'captcha',
                        'width'        => 120,
                        'height'       => 40,
                        'length'       => 5,
                        'clabel'       => __("Captcha"),
                        'cplaceholder' => __("Captcha"),
                        'reload_txt'   => '<i class="fa fa-refresh"></i>',
                        ]);
                        /* $captcha['input']; */
                        ?>
                      <div class="input-group">
                        <input type="text" name="captcha" id="captcha" autocomplete="off" class="form-control" placeholder="Enter captcha code">
                        <span >
                        <?= $captcha['captcha'];?>
                        <?= $captcha['reload'];?>
                      </span>
                      </div>
                      
                      <button type="submit" class="btn">Login</button>
                    <?= $this->Form->end(); ?>
                  </div>
                </div>
              
              <div class="social-login">
                <div class="social-login-buttons">
                  <?=  $this->Html->link(__('Forgot password'), ['action' => 'forgotPassword'],['class' =>'btn btn-link-2']) ?>
                  <?php //echo $this->Html->link(__('New Registration'), ['prefix'=>false,'controller'=>'Registration','action' => 'index'],['class' =>'btn btn-link-2']) ?>
                </div>
              </div>
            </div>
          </div>          
      </div>
    </div>  
</div>
<style type="text/css">
  input#captcha {
    width: 55%;
    float: left;
    margin-right: 2%;
  }
</style>
<?php $this->append('bottom-script');?>
<script type="text/javascript">
  $(document).ready(function() {    
    $("#loginform").validate({
      rules:{
        'captcha':{
          required:true,
        },
        'email':{
            required:true,
            email: true,
            emailt: true
          },
        'password' : {
            required: true,
          },
      },
      messages:{
        'captcha':{
          required:"Captcha field is required",
        },
        'email':{
            required:"Email field is required",
            email: 'Enter valid mail id',
            emailt : 'This is not valid mail'
          },
        'password' : {
            required: "Password field is required",
          }
       }
      });
  })

  jQuery.validator.addMethod("emailt", function(value, element) {
    return this.optional(element) || /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test(value);
  }, "Your entered invalid email id");

  $('#reset').on('click', function () {
    var validator = $("#loginform").validate();
    validator.resetForm();
    validator.reset();
  });
</script>
<?php echo $this->Html->script('jquery.jcryption.3.1.0.js'); ?>
<script type="text/javascript">  
  $(function() {
    var encryptUrl = "<?php echo $this->Url->build([
                    'controller' => 'Users',
                    'action' => 'jcryption']); ?>";
    $("#loginform").jCryption({
        getKeysURL: encryptUrl + "?getPublicKey=true",    
        handshakeURL: encryptUrl + "?handshake=true",
        beforeEncryption: function() { 
          return $("#loginform").valid(); 
        }
    });
  });

  $(document).ajaxSend(function(e, xhr, settings) {
    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
  });
  
  $(function() {
    $('.creload').on('click', function() {
      var mySrc = $(this).prev().attr('src');
      var glue = '?';
      if(mySrc.indexOf('?')!=-1)  {
        glue = '&';
      }
      $(this).prev().attr('src', mySrc + glue + new Date().getTime());
      return false;
    });
  });
</script>
<?php $this->end();?>