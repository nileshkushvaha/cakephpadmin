<?php 
$email = isset($email)?$email:'';
$mobile_number = isset($mobile_number)?$mobile_number:'';
$this->append('bottom-style');?>
<style type="text/css">

</style>
<?php $this->end(); ?>
<div class="top-content">          
    <div class="final-register">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text">
              <h1><strong>SilverCMS</strong> Register Forms</h1>
              <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                <?= $this->Flash->render(); ?>
                <?= $this->Flash->render('auth'); ?>
              </div>
            </div>
          </div>
            <div class="row">
              <?= $this->Form->create('registration',['id'=>'registration','class' => 'cmsregistration form-inline','autocomplete'=>'off']); ?>
              <?php  $shorname = array('Dr.'=>'Dr.','Mr.'=>'Mr.','Shri'=>'Shri','Mrs.'=>'Mrs.','Miss'=>'Miss'); ?>
                <div class="col-sm-12">
                  <div class="form-box" style="margin-top: 20px;">
                    <div class="form-bottom">
                      <div class="col-sm-6">
                        <?= $this->Form->control('shortname',['options' => $shorname,'empty' =>'--Select--','label' => ['class' => 'col-sm-3'],'select' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('name',['label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-sm-6">
                        <?php $genderOptns = ['1' => 'Male','2' => 'Female','3' => 'Other']; ?>
                        <?=  $this->Form->control('gender',['options' => $genderOptns,'label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('date_of_birth',['empty' => '--Select--','label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('designation_id',['options' => $designations,'label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('organization',['label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('email',['label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9'],'value'=>$email,'readonly'=>true]); ?>
                      </div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('mobile_number',['label' => ['class' => 'col-sm-3','text' => 'Mobile no.'],'input' => ['class' => 'col-sm-9'],'value'=>$mobile_number,'readonly'=>true]); ?>
                      </div>                      
                      <div class="clearfix"></div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('phone',['label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('fax',['label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>                      
                      <div class="clearfix"></div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('state_id',['options' => $states,'empty' => '--Select--','label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('district_id',['options' => $districts,'empty' => '--Select--','label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>                      
                      <div class="clearfix"></div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('city_id',['label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('pincode',['label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('password',['label' => ['class' => 'col-sm-3'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="col-sm-6">
                        <?=  $this->Form->control('confirm_password',['label' => ['class' => 'col-sm-3','text' => 'Retype'],'input' => ['class' => 'col-sm-9']]); ?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-sm-12 text-center"> <br>
                        <button type="submit" class="btn">Sign in!</button>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>            
        </div>
    </div>    
</div>

<?php $this->append('bottom-script');?>

<script type="text/javascript">
var baseUrl = "<?php echo $this->Url->build('/registration', true);?>";

  $('#state-id').on('change',function(){
    var stateId = $('#state-id').val();
    $.ajax({
        type:'POST',
        async: true,
        cache: false,
        url: baseUrl + '/getDistrictList',
        data: {
            state_id : stateId,
        },
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
        },
        success: function(data) {
            if(stateId == 0){
              var optiond = "<option value=''>--Select--</option>";
              $('#district-id').html(optiond);
            }else{
              $('#district-id').html(data);
            }
            var option = "<option value=''>--Select--</option>";
            $('#city-id').html(option);
        },
        error:function (){
            alert('I am in Error');
        },
    });
})

$('#district-id').on('change',function(){
    var district_id = $('#district-id').val();
    $.ajax({
        type:'POST',
        async: true,
        cache: false,
        url: baseUrl + '/getCityList',
        data: {
            district_id : district_id,
        },
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
        },
        success: function(data) {
          $('#city-id').html(data);
        },
        error:function (){
          alert('I am in Error');
        },
    });
})

  
  jQuery.validator.addMethod("nameV", function(value, element) {
    return this.optional(element) || /^[a-zA-Z].*[a-zA-Z ]{2,30}$/.test(value);///^[a-zA-Z ]{2,30}$/
  }, "Enter Valid Name");

  jQuery.validator.addMethod("passwordV", function(value, element) {
    return this.optional(element) || /^(?=.*[0-9])[a-zA-Z0-9]{6,12}$/.test(value);////^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/
  }, "Password should be alpha-numeric and between 6-12 digits.");
  
  $.validator.addMethod("mobileno", function(value, element) {
    return this.optional(element) || /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/.test(value);
  }, "Please specify a valid mobile number");

  jQuery.validator.addMethod("pincode", function(value, element){
    return this.optional(element) || /^([1-9])([0-9]){5}$/.test(value);
  }, "Invalid pincode");
    
  jQuery.validator.addMethod("emailt", function(value, element) {
    return this.optional(element) || /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test(value);
  }, "You have entered invalid email id");

  jQuery.validator.addMethod("emaildot", function(value, element) {
      var value2 = value.split('@');
      if((value2[1].split(".").length-1)> 2) {
          return false;
        } else {
            return true;
        }
  }, "You have entered invalid emaildot");

  jQuery.validator.addMethod("pwcheck", function(value) {
        return /[\@\#\$\%\^\&\*\(\)\_\+\!\?]/.test(value) // At least one special character
            && /[a-z]/.test(value) // At least one lower case English letter
            && /[0-9]/.test(value) // At least one digit
            && /[A-Z]/.test(value) // At least one upper case English letter
    });
    
    var validator = $("#registration").validate({
    rules: {
      shortname :{
        required: true,
      },
      name : {
        required: true,
      },
      gender : {
        required: true,
      },
      date_of_birth : {
        required: true,
      },
      pincode :{
        required:true,
        pincode :true,
        maxlength: 6
      },
      email:{
        required: true,
        emailt: true,
        email : true,
        emaildot :true,
        remote : {
                url: baseUrl + '/emailCheck/',
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
          url: baseUrl + '/mobileexists/',
          type: "post",
          beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
          }
        }
      },
      phone:{
        minlength: 11,
        maxlength: 14
      },
      fax:{
        minlength: 11,
        maxlength: 14
      },
      address : {
        required: true,
      },      
      password : {
        required:true,
        rangelength: [8, 20],
        pwcheck: true,
      },
      confirm_password:{
        equalTo: "#password"
      }
    },                             
    messages: {
      shortname : {
        required: "Select your titles",
      },
      name : {
        required: " Enter full name",
      },
      gender : {
        required: " Select Gender",
      },
      pincode : {
        required: "Enter Pincode",
        pincode : "Enter valid pincode",
        maxlength: "max length only {0} digits",
      },
      address : {
        required: " Enter Address",
      },      
      password : {
        required:"Enter Password",
        rangelength:"Password should be minimum {8} and maximum {20} character",
        pwcheck: "Password should be at least one uppercase letter, one lowercase letter, one number and one special character",
      },
      confirm_password :" Enter Confirm Password Same as Password",
      email: {
        required: "Enter email",
        emailt: "Enter a valid email..!",
        email : 'Enter a valid email..!',
        emaildot :'Enter a valid email..!',
        remote: "Email id already exists..!"
      },
      mobile_number: {
        required: "Enter mobile number",
        mobileno: "Enter a valid Mobile Number..!",
      },
      phone: {
        minlength:  "Enter valid phone number.",
        maxlength: "Enter valid phone number.",                
      },
      fax: {
        minlength:  "Enter valid fax number.",
        maxlength: "Enter valid fax number.",                
      }
    }
    });

    $("#cancel").click(function() {
    var form = $("#registernormal");
    form.validate().resetForm(); // clear out the validation errors
    form[0].reset(); // clear out the form data
    return false;
    });
  

$('#designation_id').change(function(){
  if($('#designation_id option:selected').text() == "Others"){
    $('.others').show();
  } else {
    $('#other_designation').val('');
    $('.others').hide();
  }
});


  $('#phone').on('input', function() {
    var number = $(this).val().replace(/[^\d]/g, '')
    if (number.length == 10) {
      number = number.replace(/(\d{2})(\d{8})/, "$1-$2");
    } else if(number.length == 11) {
      number = number.replace(/(\d{3})(\d{8})/, "$1-$2");
    } else if(number.length == 12) {
      number = number.replace(/(\d{4})(\d{8})/, "$1-$2");
    } else if(number.length == 13) {
      number = number.replace(/(\d{5})(\d{8})/, "$1-$2");
    }
    $(this).val(number);
    $('#phone').attr({ maxLength : 14 });
  });
  
  $('#fax').on('input', function() {
    var number = $(this).val().replace(/[^\d]/g, '')
    if (number.length == 10) {
      number = number.replace(/(\d{2})(\d{8})/, "$1-$2");
    } else if(number.length == 11) {
      number = number.replace(/(\d{3})(\d{8})/, "$1-$2");
    } else if(number.length == 12) {
      number = number.replace(/(\d{4})(\d{8})/, "$1-$2");
    } else if(number.length == 13) {
      number = number.replace(/(\d{5})(\d{8})/, "$1-$2");
    }
    $(this).val(number)
    $('#fax').attr({ maxLength : 14 });
  });

</script>
<?php $this->end(); ?>