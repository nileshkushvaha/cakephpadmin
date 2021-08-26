<div class="top-content">          
  <div class="inner-bg">
      <div class="container">          
          <div class="row">
              <div class="registration-form">                
                <div class="form-box">
                  <div class="form-top">
                    <div class="form-top-left">
                      <h3>Forgot Password?</h3>
                        <p>You can reset your password here.</p>
                    </div>
                    <div class="form-top-right">
                      <i class="fa fa-lock"></i>
                    </div>
                  </div>                  
                  <div class="form-bottom">
                    <?= $this->Flash->render(); ?>
                    <?= $this->Flash->render('auth'); ?>
                    <?= $this->Form->create('forgotPassword',['id'=>'forgotPassword','class' => 'login-form']); ?>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email address">
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
                      <br>                    
                      <button type="submit" class="btn">Reset Password</button>
                    <?= $this->Form->end(); ?>
                  </div>
                </div>
              
              <div class="social-login">
                <div class="social-login-buttons">
                  <?= $this->Html->link(__('Login'), ['action' => 'login'],['class' =>'btn btn-link-2']) ?>
                  <?php //echo $this->Html->link(__('Registration'), ['controller'=>'Registration','action' => 'index'],['class' =>'btn btn-link-2']) ?>
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
    $("#forgotPassword").validate({
      rules:{
        'email':{
            required:true,
            email: true,
            emailt: true
          },
      },
      messages:{
        'email':{
            required:"Email field is required",
            email: 'Enter valid mail id',
            emailt : 'This is not valid mail'
          }
       }
      });
  });

  jQuery.validator.addMethod("emailt", function(value, element) {
    return this.optional(element) || /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test(value);
  }, "Your entered invalid email id");

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