<?php  
$lang = 'en';
if ($Configure::check('language')) {
  $lang = $Configure::read('language.culture');
}
?>

<section class="login-block">
  <div class="container">
  <div class="row">
    <div class="col-md-4 login-sec">
      <h2 class="text-center">Forgot Password</h2>
      <?= $this->Flash->render(); ?>
      <?= $this->Form->create('forgotPassword',['id'=>'forgotPassword','autocomplete'=>'off']); ?>
        <?php echo $this->Form->control('username',['autocomplete'=>'off','required'=>true,'placeholder'=>'Enter email','label'=>'Email','maxlength'=>'60','value'=>'']);?>

        <?php //echo $this->Form->control('password',['autocomplete'=>'off','required'=>true,'placeholder'=>'Enter Password','maxlength'=>'60']);?>

        <?= $this->Form->button(__('Submit'),['class'=>'btn border-btn btn-block']); ?>
      <?= $this->Form->end();?>
      <div class="sign-up">
        Don't have an account? <?= $this->Html->link(__('Create One'),['action' => 'registration']); ?>
      </div>
      <div class="sign-up">
        Already a member? <?= $this->Html->link(__('Login'),['action'=>'login']);?>
      </div>
    </div>

    <div class="col-md-8 banner-sec"></div>
  </div>
</section>

<?php $this->append('bottom-script');?>
<?= $this->Html->script(['../assets/js/jquery.validate.min']); ?>
<script type="text/javascript">
  $(document).ready(function() {    
    $("#forgotPassword").validate({
      rules:{
        'username':{
          required:true,
          email: true
        },
      },
      messages:{
        'username':{
          required:"Email field is required",
          email: 'Enter valid mail id'
        }
      }
    });
  });

  $.validator.addMethod("emailt", function(value, element) {
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