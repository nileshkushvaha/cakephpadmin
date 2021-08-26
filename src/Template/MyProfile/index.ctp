<?php
use Cake\Core\Configure;
$lang = 'en';
if ($Configure::check('language')) {
  $lang = $Configure::read('language.culture');
}
$this->assign('title', __('My Profile'));
$this->assign('subtitle', __('My Profile'));
$this->Breadcrumbs->add(__('My Profile'));

$this->Html->meta('keywords', 'My Profile', ['block' => true]);
$this->Html->meta('description', "My Profile", ['block' => true]);
$userData = $this->request->getSession()->read('Auth.User');
$roleId = $userData['role_id'];
//pr($profilePercentage); die;
?>

<div class="admin-first-top site-admin-container">
	<?=$this->element('topbar');?>
	<section class="ad-profileDetails-section">
		<div class="container ">
			<h3 class="title mt-3">About <?=$user->name?></h3>
			<p class=""> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<div class="row">
				<div class="col-md-3">
					<div class="text-left mb-4">
						<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
						<div class="form-group">
							<label for="profilePhoto">Upload a different photo...</label>
							<input type="file" class="form-control-file file-upload" id="profilePhoto">
						</div>
					</div>
					<div class="card mb-4">
						<div class="card-header"> Activity </div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><strong>Shares</strong></li>
							<li class="list-group-item"><strong>Likes</strong></li>
							<li class="list-group-item"><strong>Posts</strong></li>
							<li class="list-group-item"><strong>Products</strong></li>
						</ul>
					</div>
					<div class="card mb-4">
						<div class="card-header">
							Social Media
						</div>
            <div class="card-body" style="padding:1.25rem">
              <div class="social-share">
                <h5 class="card-title">We're A Social Bunch!</h5>
                <a href="javascript:void(0);"><i class="fab fa-facebook"></i> </a>
                <a href="javascript:void(0);"><i class="fab fa-instagram"></i> </a>
                <a href="javascript:void(0);"><i class="fab fa-twitter"></i> </a>
                <a href="javascript:void(0);"><i class="fab fa-pinterest"></i> </a>
                <a href="javascript:void(0);"><i class="fab fa-linkedin"></i></a>
              </div>
						</div>
					</div>
				</div>
        
				<div class="col-md-9">
          <?= $this->Form->create($profile,['id' => 'profileForm']); ?>
          <?= $this->Flash->render() ; ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first-name"> First name </label>
                  <input type="text" class="form-control" name="first_name" id="first-name" placeholder="first name" title="enter your first name if any." value="<?=isset($profile['first_name'])?$profile['first_name']:''?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="last-name"> Last name </label>
                  <input type="text" class="form-control" name="last_name" id="last-name" placeholder="last name" title="enter your last name if any." value="<?=isset($profile['last_name'])?$profile['last_name']:''?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="mobile-number"> Mobile </label>
                  <input type="text" class="form-control" name="mobile_number" id="mobile-number" placeholder="enter mobile number" title="enter your mobile number if any.">
                  <input type="hidden" name="country_code" id="country-code" value="<?=isset($profile['country_code'])?$profile['country_code']:''?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email"> Email </label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email." value="<?=isset($profile['email'])?$profile['email']:''?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="gender"> Gender </label>
                  <div class="input-group">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="gender1" name="gender" class="custom-control-input" value="1" <?=$profile['gender']=="1" ? "checked" : ""?>>
                      <label class="custom-control-label" for="gender1">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="gender2" name="gender" class="custom-control-input" value="2" <?=$profile['gender']=="2" ? "checked" : ""?>>
                      <label class="custom-control-label" for="gender2">Female</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date-of-birth"> Date of Birth </label>
                  <input type="date" class="form-control" name="date_of_birth" id="date-of-birth" title="Select your birth date." value="<?=isset($profile['date_of_birth'])? date('Y-m-d',strtotime($profile['date_of_birth'])) :''?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="website"> Website </label>
                  <input type="text" class="form-control" name="website" id="website" placeholder="enter your website" title="enter your website." value="<?=isset($profile['website'])?$profile['website']:''?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="city"> City / Location </label>
                  <input type="text" class="form-control" name="city_name" id="city" placeholder="enter city name" title="enter your city name." value="<?=isset($profile['city_name'])?$profile['city_name']:''?>">
                </div>
              </div>              
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country"> Country </label>
                  <input type="text" class="form-control" name="country" id="country" placeholder="enter your country" title="enter your country." value="<?=isset($profile['country'])?$profile['country']:''?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="pincode"> Pincode </label>
                  <input type="text" class="form-control" name="pincode" id="pincode" placeholder="enter pincode" title="enter your pincode." value="<?=isset($profile['pincode'])?$profile['pincode']:''?>">
                </div>
              </div>              
            </div>

            <div class="form-group">
              <label for="address">Address</label>
              <textarea id="address" class="form-control" name="address" rows="3"><?=isset($profile['address'])?$profile['address']:''?></textarea>
            </div>

            <div class="form-group">
              <?= $this->Form->button(__('Update'),['class' => 'btn border-btn']);?>
            </div>
          <?php echo $this->Form->end();?>    
				</div>
			</div>
		</div>
  </section>
</div>
<?php 
$mobileWithCountry='';
$countryCode = isset($profile['country_code'])?$profile['country_code']:'';
if($countryCode){
  $mobileWithCountry = '+'.isset($profile['country_code'])?$profile['country_code']:''.''.isset($profile['mobile_number'])?$profile['mobile_number']:'';
}
$rand_number = (rand());
?>
<?= $this->Html->css(['../assets/intl/css/intlTelInput.css']); ?>
<?php $this->append('bottom-script');?>
<?php echo $this->Html->script(['jquery.validate.min','jquery-additional-methods.min']); ?>
<?php echo $this->Html->script(['../assets/intl/js/intlTelInput.js?'.$rand_number]); ?>

<script>
$(document).ready(function() {
  var readURL = function(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('.avatar').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $(".file-upload").on('change', function(){
      readURL(this);
  });
});
</script>

<?php echo $this->Html->script(['../assets/intl/js/intlTelInput.js']); ?>
<script>
  var inputa = document.querySelector("#mobile-number");
  // initialise plugin
  var rand_number = Math.floor((3-1)*Math.random()) + 1;
  var iti = window.intlTelInput(inputa, {
    preferredCountries: ['in', 'gb', 'us'],
    separateDialCode: true,
    utilsScript: "<?php echo $this->Url->build('/assets/intl/js/utils.js?'.$rand_number); ?>",
  });
  iti.setNumber("<?=$mobileWithCountry?>");
  var selectedCountry = iti.getSelectedCountryData();
  var selectedNumber = selectedCountry.dialCode;
  var selectedName = selectedCountry.name;
  $('#country-code').val(selectedNumber);

  inputa.addEventListener("countrychange", function() {
    var selectedCountry = iti.getSelectedCountryData();
    var selectedNumber = selectedCountry.dialCode;
    var selectedName = selectedCountry.name;
    $('#country-code').val(selectedNumber);
  });


var baseUrl = "<?php echo $this->Url->build('/'.$lang.'/users', true);?>";

$.validator.addMethod("nameV", function(value, element) {
  return this.optional(element) || /^[a-zA-Z].*[a-zA-Z ]{2,30}$/.test(value);
}, "Enter Valid Name");

$.validator.addMethod("validNumber", function(value, element) { 
    if (value.trim()) {
      if (iti.isValidNumber()) {
        return true;
      } else {
        return false;
      }
  }
  return false;
},
"Please enter a valid mobile number."
);

$(function() {

  $("#profileForm").validate({
    rules: {
      first_name: {
        required: true,
        nameV: true
      },
      last_name: {
        required: true,
        nameV: true
      }
    },
    mobile_number:{
      required:true,
      validNumber:true,
      remote : {
        url: baseUrl + '/mobileexists/',
        type: "post",
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
        }
      }
    },
    messages: {
      first_name: {
        required: "Enter first name",
        nameV: "Enter valid name"
      },
      last_name: {
        required: "Enter last name",
        nameV: "Enter valid name"
      },
      mobile_number: {
        required: "Enter mobile number",
        //mobileno: "Enter a valid Mobile Number..!",
        remote: "Mobile number already exists..!"
      },
    },
    submitHandler: function (form) {
     form.submit();
    }
  });
});
</script>
<?php $this->end();?>