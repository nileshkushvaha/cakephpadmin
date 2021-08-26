<?php 
$lang = 'en';
if ($Configure::check('language')) {
	$lang = $Configure::read('language.culture');
}
$roleId = isset($userdata['role_id'])?$userdata['role_id']:'';
$name = isset($userdata['name'])?$userdata['name']:'';
$email = isset($userdata['email'])?$userdata['email']:'';
$mobileNumber = isset($userdata['mobile_number'])?$userdata['mobile_number']:'';
?>
<?= $this->Html->css(['../assets/intl/css/intlTelInput.css']); ?>
<section class="login-block">
  <div class="container">
  <div class="row">
    <div class="col-md-7 login-sec">
      <h2 class="text-center">Registration</h2>
      <?= $this->Flash->render(); ?>
      <?= $this->Form->create('registration',['id'=>'fregistration','autocomplete'=>'off']); ?>
      	<div class="row">
			<div class="col-md-6">
				<?php echo $this->Form->control('name',['autocomplete'=>'off','required'=>true,'placeholder'=>'Enter Name','maxlength'=>'60','value'=>$name]);?>
			</div>
			<div class="col-md-6">
				<?php echo $this->Form->control('email',['autocomplete'=>'off','required'=>true,'placeholder'=>'Enter Email','maxlength'=>'60','autocomplete'=>'off','value'=>$email]);?>
			</div>
			<div class="col-md-6">
				<?php echo $this->Form->control('mobile_number',['autocomplete'=>'off','required'=>true,'placeholder'=>'Enter Mobile No','maxlength'=>'15','value'=>$mobileNumber]);?>
			</div>
			<div class="col-md-6">
				<?php echo $this->Form->control('password',['autocomplete'=>'off','required'=>true,'placeholder'=>'Enter Password','maxlength'=>'100']);?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group">
		        <div class="form-check">
		          <input class="form-check-input" name="acceptterm" type="checkbox" value="" id="acceptterm" required>
		          <label class="form-check-label" for="acceptterm">
		            <small>By clicking Submit, you agree to our Terms & Conditions, Visitor Agreement and Privacy Policy.</small>
		          </label>
		        </div>
			</div>
			<?= $this->Form->button(__('Submit'),['class'=>'btn border-btn']); ?>
		</div>
        <div class="signupright text-right">
	        Already a member? <?= $this->Html->link(__('Login'),['action'=>'login']);?>
	    </div>
      <?= $this->Form->end();?>
    </div>
    <div class="col-md-5 banner-sec"></div>
  </div>
</section>


<?php $this->append('bottom-script');?>

<?= $this->Html->script(['../assets/js/jquery.validate.min.js','https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js']); ?>

<script>

var baseUrl = "<?php echo $this->Url->build('/'.$lang.'/users', true);?>";

$.validator.addMethod("nameV", function(value, element) {
	return this.optional(element) || /^[a-zA-Z].*[a-zA-Z ]{2,30}$/.test(value);
}, "Enter Valid Name");

$.validator.addMethod("pwcheck", function(value) {
    return /[\@\#\$\%\^\&\*\(\)\_\+\!\?]/.test(value) // At least one special character
        && /[a-z]/.test(value) // At least one lower case English letter
        && /[0-9]/.test(value) // At least one digit
        && /[A-Z]/.test(value) // At least one upper case English letter
});
$(document).ready(function(){
	$("#fregistration").validate({
		rules: {
			'name' : {
				required: true,
				nameV: true,
			},
			'email':{
				required: true,
				email : true,
				remote : {
					url: baseUrl + '/emailcheck/',
					type: "post",
					beforeSend: function (xhr) {
						xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
					}
				}
			},
			'mobile_number':{
				required:true,
	        },
	        'password' : {
	        	required:true,
	        	rangelength: [8, 20],
	        	pwcheck: true,
	        }
	    },                             
	    messages: {
	    	'name' : {
	    		required: " Enter full name",
	    		nameV : "Enter valid name"
	    	},
	    	'password' : {
	    		required:"Enter Password",
	    		rangelength:"Password should be minimum {8} and maximum {20} character",
	    		pwcheck: "Password should be at least one uppercase letter, one lowercase letter, one number and one special character",
	    	},
	    	'email': {
	    		required: "Enter email",
	    		email : 'Enter a valid email..!',
	    		remote: "Email id already exists..!"
	    	},
	    	'mobile_number': {
	    		required: "Enter mobile number"
	        }
	    },
	    submitHandler: function (form) {
	     	form.submit();
	    }
	});
});
</script>
<?php echo $this->Html->script('jquery.jcryption.3.1.0.js'); ?>
<script>  
	$(function() {
		var encryptUrl = "<?php echo $this->Url->build([
		'controller' => 'Users',
		'action' => 'jcryption']); ?>";
		$("#fregistration").jCryption({
			getKeysURL: encryptUrl + "?getPublicKey=true",    
			handshakeURL: encryptUrl + "?handshake=true",
			beforeEncryption: function() { 
				return $("#fregistration").valid(); 
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

<?php echo $this->Html->script(['../assets/intl/js/intlTelInput.js']); ?>
<script>
    var inputa = document.querySelector("#mobile-number");
	window.intlTelInput(inputa, {
      	preferredCountries: ['in', 'us'],
      	separateDialCode: true,
      	utilsScript: "<?php echo $this->Url->build('/assets/intl/js/utils.js'); ?>",
    });
</script>
<?php $this->end();?>